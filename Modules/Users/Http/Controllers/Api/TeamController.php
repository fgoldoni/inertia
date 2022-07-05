<?php

namespace Modules\Users\Http\Controllers\Api;

use App\Repositories\Criteria\Limit;
use App\Repositories\Criteria\Where;
use App\Repositories\Criteria\WhereLike;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Users\Http\Requests\TeamRequest;
use Modules\Users\Repositories\Contracts\TeamsRepository;
use Modules\Users\Transformers\TeamResource;

class TeamController extends Controller
{
    public function __construct(
        private readonly ResponseFactory $response,
        private readonly TeamsRepository $teamsRepository,
        private readonly Request $request
    ) {
    }

    public function index()
    {
        $data = TeamResource::collection($this->teamsRepository->all());

        return $this->response->json(['data' => $data], Response::HTTP_OK, [], JSON_NUMERIC_CHECK);
    }


    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('users::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }


    public function show(TeamRequest $request, string $subdomain)
    {
        $data = new TeamResource($this->teamsRepository->withCriteria([
            new Where('subdomain', $subdomain)
        ])->first());

        return $this->response->json(['data' => $data], Response::HTTP_OK, [], JSON_NUMERIC_CHECK);
    }


    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('users::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
