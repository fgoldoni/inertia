<?php

namespace Modules\Applicants\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\Criteria\EagerLoad;
use App\Repositories\Criteria\OrderBy;
use App\Repositories\Criteria\WhereHas;
use App\Repositories\Criteria\WhereKey;
use App\Repositories\Criteria\WhereLike;
use App\Repositories\Criteria\WherePublished;
use App\Repositories\Criteria\WhereUser;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Inertia\Inertia;
use Modules\Activities\Repositories\Contracts\ActivitiesRepository;
use Modules\Applicants\Entities\Applicant;
use Modules\Applicants\Enums\Status;
use Modules\Applicants\Http\Requests\StoreApplicantRequest;
use Modules\Applicants\Http\Requests\UpdateApplicantRequest;
use Modules\Applicants\Http\Requests\UpdateApplicantStatusRequest;
use Modules\Applicants\Repositories\Contracts\ApplicantsRepository;
use Modules\Applicants\Transformers\ApplicantsResource;
use Modules\Applicants\Transformers\CandidateResource;
use Modules\Attachments\Repositories\Contracts\AttachmentsRepository;
use Modules\Jobs\Repositories\Contracts\JobsRepository;
use Modules\Users\Repositories\Contracts\UsersRepository;

class ApplicantsController extends Controller
{
    public function __construct(
        private readonly ApplicantsRepository $applicantsRepository,
        private readonly JobsRepository $jobsRepository,
        private readonly UsersRepository $usersRepository,
        private readonly ActivitiesRepository $activitiesRepository,
        private readonly AttachmentsRepository $attachmentsRepository,
        private readonly ResponseFactory $response,
        private readonly Request $request,
        private readonly Redirector $redirect
    ) {
    }

    public function index(array $modalProps = [])
    {
        Inertia::share('can', fn (Request $request) => $request->user() ? [
            'is_impersonated' => $request->user()->isImpersonated(),
            'create' => $request->user()->can('create', Applicant::class),
            'edit' => $this->request->user()->hasPermissionTo('edit_applicants'),
            'delete' => $this->request->user()->hasPermissionTo('delete_applicants'),
        ] : null);

        return Inertia::render('Modules/Applicants/Index', array_merge([
            'filters' => $this->request->only(['search', 'perPage', 'page', 'field', 'direction']),
            'rowData' => $this->applicantsRepository->withCriteria([
                new WhereLike([
                    'applicants.id',
                    'applicants.user_id',
                    'applicants.job_id',
                    'applicants.status',
                ], $this->request->get('search')),
                new OrderBy($this->request->get('field', ''), $this->request->get('direction')),
                new EagerLoad([
                    'candidate:id,name,email',
                    'job' => function (BelongsTo $query) {
                        $query->with(['city']);
                    },
                ]),
                new WhereHas('job', function (Builder $query) {
                    $query->where('jobs.team_id', auth()->user()->currentTeam->id);
                }),
            ])->paginate()->withQueryString()
                ->through(fn ($applicant) => [
                    'id' => $applicant->id,
                    'job' => [
                        'name' => $applicant->job->name,
                        'city' => $applicant->job->city?->name,
                        'avatar_url' => $applicant->job->avatar_url,
                    ],
                    'status' => $applicant->status,
                    'phone' => $applicant->phone,
                    'created_at' => $applicant->created_at->format('d, M Y'),
                    'candidate' => [
                        'id' => $applicant->candidate->id,
                        'name' => $applicant->candidate->name.' ( '.$applicant->candidate->email.' ) ',
                    ],
                ]),

        ], $modalProps));
    }

    public function create(Request $request)
    {
        $this->authorize('create', Applicant::class);

        Inertia::modal('Modules/Applicants/CreateModal');

        Inertia::basePageRoute(
            route(
                'admin.applicants.index',
                $this->request->only(['search', 'perPage', 'page', 'field', 'direction'])
            )
        );

        return $this->index([
            'states' => $this->applicantsRepository->getStates(),
            'editing' => new ApplicantsResource($this->applicantsRepository->make([
                'id' => null,
                'job_id' => null,
                'user_id' => null,
                'phone' => '+4915736795436',
                'message' => null,
                'status' => Status::Pending,
            ])),
        ]);
    }

    public function store(StoreApplicantRequest $request)
    {
        $this->applicantsRepository->create(
            $request->only(
                'user_id',
                'job_id',
                'phone',
                'status',
                'message',
            )
        );

        return $this->response->json(
            [
                'message' => __('The (:item) has been successfully created', ['item' => 'applicant']),
            ],
            Response::HTTP_OK,
            [],
            JSON_NUMERIC_CHECK
        );
    }

    public function show($applicant = null)
    {
        $result = [];
        $result['jobs'] = $this->jobsRepository
            ->withCriteria([new WherePublished()])->get(['jobs.id', 'jobs.name', 'jobs.team_id']);

        if (auth()->user()->isAdministrator()) {
            $result['candidates'] = CandidateResource::collection($this->usersRepository
                ->withCriteria([new WhereUser()])
                ->get(['users.id', 'users.name', 'users.email']));
        } else {
            $result['candidates'] = CandidateResource::collection(auth()->user()->currentTeam()->first()
                ->users()->role(config('app.system.users.roles.default'))
                ->get(['users.id', 'users.name', 'users.email']));
        }

        return $this->response->json(['data' => $result], Response::HTTP_OK, [], JSON_NUMERIC_CHECK);
    }

    public function edit(Request $request, Applicant $applicant)
    {
        $this->authorize('edit', $applicant);

        Inertia::modal('Modules/Applicants/EditModal');

        Inertia::basePageRoute(
            route(
                'admin.applicants.index',
                $this->request->only(['search', 'perPage', 'page', 'field', 'direction'])
            )
        );

        return $this->index([
            'states' => $this->applicantsRepository->getStates(),
            'editing' => new ApplicantsResource($this->applicantsRepository->withCriteria([
                new EagerLoad([
                    'candidate:id,name,email',
                    'job' => fn ($query) => $query->with('city'),
                ]),
                new WhereHas('job', function (Builder $query) {
                    $query->where('jobs.team_id', auth()->user()->currentTeam->id);
                }),
            ])->find($applicant->id)),
        ]);
    }

    public function update(UpdateApplicantRequest $request, Applicant $applicant)
    {
        $applicant = $this->applicantsRepository->update(
            $applicant->id,
            $request->only(
                'user_id',
                'job_id',
                'phone',
                'message',
            )
        );

        return $this->response->json(
            [
                'model' => new ApplicantsResource($applicant->load([
                    'candidate',
                    'job' => fn ($query) => $query->with('city'),
                ])),
                'message' => __('The Company (:item) has been successfully updated', ['item' => 'applicant']),
            ],
            Response::HTTP_OK,
            [],
            JSON_NUMERIC_CHECK
        );
    }

    public function updateStatus(UpdateApplicantStatusRequest $request, Applicant $applicant)
    {
        $applicant = $this->applicantsRepository->update(
            $applicant->id,
            $request->only('status')
        );

        return $this->response->json(
            [
                'model' => new ApplicantsResource($applicant->load([
                    'candidate',
                    'job' => fn ($query) => $query->with('city'),
                ])),
                'message' => __('The Status has been successfully updated'),
            ],
            Response::HTTP_OK,
            [],
            JSON_NUMERIC_CHECK
        );
    }

    public function destroy($selected)
    {
        $items = $this->applicantsRepository->withCriteria([
            new WhereKey(explode(',', (string) $selected)),
        ])->get();

        foreach ($items as $item) {
            $item->delete();
        }

        return $this->response->json(
            ['message' => __('The Applicant(s) has been successfully deleted')],
            Response::HTTP_OK,
            [],
            JSON_NUMERIC_CHECK
        );
    }
}
