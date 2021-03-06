<?php

namespace Modules\Jobs\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\Criteria\EagerLoad;
use App\Repositories\Criteria\OrderBy;
use App\Repositories\Criteria\Select;
use App\Repositories\Criteria\WhereKey;
use App\Repositories\Criteria\WhereLike;
use App\Repositories\Criteria\WithTrashed;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Inertia\Inertia;
use Modules\Activities\Repositories\Contracts\ActivitiesRepository;
use Modules\Attachments\Repositories\Contracts\AttachmentsRepository;
use Modules\Categories\Repositories\Contracts\CategoriesRepository;
use Modules\Companies\Repositories\Contracts\CompaniesRepository;
use Modules\Jobs\Entities\Job;
use Modules\Jobs\Http\Requests\StoreJobRequest;
use Modules\Jobs\Http\Requests\UpdateJobRequest;
use Modules\Jobs\Repositories\Contracts\JobsRepository;
use Modules\Jobs\Transformers\JobResource;
use Modules\Roles\Repositories\Contracts\RolesRepository;
use Modules\Teams\Services\Contracts\TeamsServiceInterface;

class JobsController extends Controller
{
    public function __construct(
        private readonly JobsRepository $jobsRepository,
        private readonly TeamsServiceInterface $teamsService,
        private readonly ActivitiesRepository $activitiesRepository,
        private readonly AttachmentsRepository $attachmentsRepository,
        private readonly CategoriesRepository $categoriesRepository,
        private readonly RolesRepository $rolesRepository,
        private readonly CompaniesRepository $companiesRepository,
        private readonly ResponseFactory $response,
        private readonly Request $request,
        private readonly Redirector $redirect
    ) {
    }

    public function index(array $modalProps = [])
    {
        Inertia::share('can', fn (Request $request) => $request->user() ? [
            'is_impersonated' => $request->user()->isImpersonated(),
            'create' => $request->user()->can('create', Job::class),
            'edit' => $this->request->user()->hasPermissionTo('edit_jobs'),
            'delete' => $this->request->user()->hasPermissionTo('delete_jobs'),
        ] : null);

        return Inertia::render('Modules/Jobs/Index', array_merge([
            'filters' => $this->request->only(['search', 'perPage', 'page', 'field', 'direction']),
            'rowData' => $this->jobsRepository->withCriteria([
                new Select(
                    'id',
                    'name',
                    'state',
                    'address',
                    'user_id',
                    'company_id',
                    'country_id',
                    'division_id',
                    'user_id',
                    'city_id',
                    'created_at',
                    'updated_at',
                    'deleted_at'
                ),
                new WhereLike(['jobs.id', 'jobs.name'], $this->request->get('search')),
                new OrderBy($this->request->get('field', ''), $this->request->get('direction')),
                new EagerLoad([
                    'user:id,name',
                    'company:id,name',
                    'categories:id,name,type',
                    'country:id,name,emoji',
                    'city:id,name',
                    'division:id,name',
                ]),
                new WithTrashed(),
            ])->paginate()->withQueryString(),

        ], $modalProps));
    }

    public function create(Request $request)
    {
        $this->authorize('create', Job::class);

        Inertia::modal('Modules/Jobs/CreateModal');

        Inertia::basePageRoute(
            route(
                'admin.jobs.index',
                $this->request->only(['search', 'perPage', 'page', 'field', 'direction'])
            )
        );

        return $this->index([
            'editing' => new JobResource($this->jobsRepository->make([
                'id' => null,
                'name' => 'test'.uniqid(),
                'content' => 'test',
                'negotiable' => false,
                'phone' => '+4915736795436',
                'online' => true,
            ])),
        ]);
    }

    public function store(StoreJobRequest $request)
    {
        $categories = array_merge(
            $request->only(
                'area',
                'job_type',
                'experience',
                'career_level',
                'gender',
                'job_level',
                'apply_type',
            ),
            $request->get('skills'),
            $request->get('benefits'),
            $request->get('responsibilities'),
        );

        $job = $this->jobsRepository->create(array_merge(
            $request->only(
                'name',
                'content',
                'address',
                'avatar_path',
                'salary_min',
                'salary_max',
                'salary_type',
                'state',
                'country_id',
                'city_id',
                'company_id'
            ),
            [
                'user_id' => $request->user()->id,
                'company_id' => $request->get('company'),
            ]
        ));

        $this->attachmentsRepository->findWhereIn(
            'id',
            $request->get('files')
        )->each(function ($item, $key) use ($job) {
            $job->attachments()->save($item);
        });

        $this->jobsRepository->sync($job->id, 'categories', $categories);

        $job->saveTags($request->get('tags', []));

        return $this->response
            ->json(
                ['message' => __('The Job (:item) has been successfully created', ['item' => $job->name])],
                Response::HTTP_OK,
                [],
                JSON_NUMERIC_CHECK
            );
    }

    public function show(User $user)
    {
        $result = $this->jobsRepository->initCategories($this->categoriesRepository->get(['id', 'name', 'type']));

        $result['states'] = $this->jobsRepository->getStates();
        $result['salaryTypes'] = $this->jobsRepository->salaryTypes();
        $result['roles'] = $this->rolesRepository->all(['id', 'name']);
        $result['teams'] = $this->teamsService->allOptionsTeams();
        $result['companies'] = $this->companiesRepository->all(['id', 'name', 'user_id', 'team_id']);

        return $this->response->json(['data' => $result], Response::HTTP_OK, [], JSON_NUMERIC_CHECK);
    }

    public function edit(Request $request, Job $job)
    {
        $this->authorize('edit', $job);

        Inertia::modal('Modules/Jobs/EditModal');

        Inertia::basePageRoute(
            route(
                'admin.jobs.index',
                $this->request->only(['search', 'perPage', 'page', 'field', 'direction'])
            )
        );

        return $this->index([
            'editing' => new JobResource($this->jobsRepository->withCriteria([
                new EagerLoad([
                    'user:id,name',
                    'activities',
                    'company:id,name',
                    'categories:id,name,type',
                    'country:id,name,emoji',
                    'city:id,name',
                    'tags:id,name',
                    'division:id,name',
                    'attachments' => function ($query) {
                        $query->select([
                            'id',
                            'name',
                            'filename',
                            'disk',
                            'attachable_id',
                            'attachable_type',
                        ])->where('attachments.disk', config('app.system.disks.uploads'));
                    },
                ]),
            ])->find($job->id, [
                'id',
                'name',
                'content',
                'slug',
                'address',
                'salary_min',
                'salary_max',
                'negotiable',
                'salary_type',
                'iframe',
                'avatar_path',
                'state',
                'user_id',
                'company_id',
                'country_id',
                'division_id',
                'user_id',
                'team_id',
                'city_id',
                'created_at',
                'updated_at',
            ])),
        ]);
    }

    public function update(UpdateJobRequest $request, Job $job)
    {
        $categories = array_merge(
            $request->only(
                'area',
                'job_type',
                'experience',
                'career_level',
                'gender',
                'job_level',
                'apply_type',
            ),
            $request->get('skills'),
            $request->get('benefits'),
            $request->get('responsibilities'),
        );

        $job = $this->jobsRepository->update($job->id, array_merge(
            $request->only(
                'name',
                'content',
                'iframe',
                'address',
                'avatar_path',
                'salary_min',
                'salary_max',
                'salary_type',
                'state',
                'country_id',
                'city_id',
                'company_id',
                'team_id'
            ),
            [
                'negotiable' => $request->get('negotiable', false),
            ]
        ));

        $this->attachmentsRepository
            ->findWhereIn('id', $request->get('files'))
            ->each(function ($item, $key) use ($job) {
                $job->attachments()->save($item);
            });

        $this->jobsRepository->sync($job->id, 'categories', $categories);

        $job->saveTags($request->get('tags', []));

        return $this->response->json(
            ['message' => __('The Job (:item) has been successfully updated', ['item' => $job->name])],
            Response::HTTP_OK,
            [],
            JSON_NUMERIC_CHECK
        );
    }

    public function destroy($selected)
    {
        $items = $this->jobsRepository->withCriteria([
            new WhereKey(explode(',', (string) $selected)),
            new WithTrashed(),
        ])->get();

        foreach ($items as $item) {
            if ($item->trashed()) {
                $item->forceDelete();
            } else {
                $item->delete();
            }
        }

        return $this->response->json(
            ['message' => __('The Job(s) has been successfully deleted')],
            Response::HTTP_OK,
            [],
            JSON_NUMERIC_CHECK
        );
    }

    public function restore(int $id)
    {
        $job = $this->jobsRepository->withCriteria([
            new WithTrashed(),
        ])->restore($id);

        return $this->response->json(
            ['message' => __('The Job (:item) has been successfully restored', ['item' => $job->name])],
            Response::HTTP_OK,
            [],
            JSON_NUMERIC_CHECK
        );
    }
}
