<?php

namespace Modules\Jobs\Http\Controllers\Api;

use App\Repositories\Criteria\OrderBy;
use App\Repositories\Criteria\WhereArea;
use App\Repositories\Criteria\WhereHas;
use App\Repositories\Criteria\WhereIn;
use App\Repositories\Criteria\WhereLike;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Jobs\Entities\Job;
use Modules\Jobs\Events\JobViewCountEvent;
use Modules\Jobs\Services\Contracts\JobsServiceInterface;

class JobsController extends Controller
{
    public function __construct(
        private readonly ResponseFactory $response,
        private readonly JobsServiceInterface $jobsService,
    ) {
    }

    public function index()
    {
        $result = $this->jobsService->apiJobs();

        return $this->response->json(['data' => $result], Response::HTTP_OK, [], JSON_NUMERIC_CHECK);
    }

    public function search(Request $request)
    {
        $jobs = $this->jobsService->search($request);

        return $this->response->json(['data' => $jobs], Response::HTTP_OK, [], JSON_NUMERIC_CHECK);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Renderable
     */
    public function create()
    {
        return view('jobs::create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    public function show(Job $job)
    {
        JobViewCountEvent::dispatch($job);

        $result = $this->jobsService->apiJob($job->id);

        return $this->response->json(['data' => $result], Response::HTTP_OK, [], JSON_NUMERIC_CHECK);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('jobs::edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
