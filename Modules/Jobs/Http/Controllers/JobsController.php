<?php

namespace Modules\Jobs\Http\Controllers;

use App\Repositories\Criteria\EagerLoad;
use App\Repositories\Criteria\OrderBy;
use App\Repositories\Criteria\Select;
use App\Repositories\Criteria\WhereKey;
use App\Repositories\Criteria\WhereLike;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Inertia\Inertia;
use Modules\Jobs\Entities\Job;
use Modules\Jobs\Http\Requests\StoreJobRequest;
use Modules\Jobs\Http\Requests\UpdateJobRequest;
use Modules\Jobs\Repositories\Contracts\JobsRepository;

class JobsController extends Controller
{
    public function __construct(private readonly JobsRepository $jobsRepository, private readonly ResponseFactory $response, private readonly Request $request)
    {
    }

    public function index(array $modalProps = [])
    {
        return Inertia::render('Modules/Jobs/Index', array_merge([
            'filters' => $this->request->only(['search', 'perPage', 'page', 'field', 'direction']),
            'rowData' => $this->jobsRepository->withCriteria([
                new Select('id', 'name', 'state', 'user_id', 'company_id', 'country_id', 'division_id', 'user_id', 'city_id', 'created_at', 'updated_at'),
                new WhereLike(['jobs.id', 'jobs.name'], $this->request->get('search')),
                new OrderBy($this->request->get('field', ''), $this->request->get('direction')),
                new EagerLoad(['user:id,name', 'company:id,name', 'categories:id,name,type', 'country:id,name,emoji', 'city:id,name', 'division:id,name']),
            ])->paginate()->withQueryString(),

        ], $modalProps));
    }

    public function create(Request $request)
    {
        Inertia::modal('Modules/Jobs/CreateModal');

        Inertia::basePageRoute(route('admin.jobs.index', $this->request->only(['search', 'perPage', 'page', 'field', 'direction'])));

        return $this->index([
            'editing' => $this->jobsRepository->make([
                'id' => null,
                'name' => 'test' . uniqid(),
                'content' => 'test',
                'email' => 'test' . uniqid() . '@test.com',
                'phone' => '+4915736795436',
                'online' => true
            ])
        ]);
    }

    public function store(StoreJobRequest $request)
    {
        $job = $this->jobsRepository->create(array_merge(
            $request->only('name', 'content', 'email', 'phone', 'online'),
            [
                'user_id' => auth()->user()->id
            ]
        ));


        return $this->response
            ->json([], Response::HTTP_CREATED, [], JSON_NUMERIC_CHECK)
            ->flash(__(':job successfully added!', ['job' => $job->name]));
    }


    public function show($id)
    {
        return view('jobs::show');
    }

    public function edit(Request $request, Job $job)
    {
        Inertia::modal('Modules/Jobs/EditModal');

        Inertia::basePageRoute(route('admin.jobs.index', $this->request->only(['search', 'perPage', 'page', 'field', 'direction'])));

        return $this->index([
            'editing' => $this->jobsRepository->withCriteria([
                new EagerLoad(['user:id,name', 'company:id,name', 'categories:id,name,type', 'country:id,name,emoji', 'city:id,name', 'division:id,name']),
            ])->find($job->id, ['id', 'name', 'state', 'user_id', 'company_id', 'country_id', 'division_id', 'user_id', 'city_id', 'created_at', 'updated_at'])
        ]);
    }

    public function update(UpdateJobRequest $request, Job $job)
    {
        $job = $this->jobsRepository->update($job->id, $request->only('name', 'content', 'email', 'phone', 'online'));

        return $this->response
            ->json([], Response::HTTP_OK, [], JSON_NUMERIC_CHECK)
            ->flash(__(':job updated successfully!', ['job' => $job->name]));
    }

    public function destroy($selected)
    {
        $this->jobsRepository->withCriteria([
            new WhereKey(explode(',', (string) $selected))
        ])->deleteAll();

        return $this->response->json(['message' => __('Job deleted successfully.')], Response::HTTP_NO_CONTENT, [], JSON_NUMERIC_CHECK);
    }
}
