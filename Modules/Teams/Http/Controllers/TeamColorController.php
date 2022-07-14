<?php

namespace Modules\Teams\Http\Controllers;

use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Teams\Http\Requests\UpdateColorTeamRequesst;
use Modules\Teams\Http\Requests\UpdateColorTeamRequest;
use Modules\Teams\Repositories\Contracts\TeamsRepository;
use Modules\Teams\Services\Contracts\TeamsServiceInterface;

class TeamColorController extends Controller
{
    public function __construct(
        private readonly TeamsRepository $teamsRepository,
        private readonly TeamsServiceInterface $teamsService,
        private readonly ResponseFactory $response,
    ) {
    }

    public function index()
    {
        return view('teams::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('teams::create');
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

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('teams::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('teams::edit');
    }



    public function update(UpdateColorTeamRequest $request, $id)
    {
        $team = $this->teamsRepository->update($id, $request->only('color'));


        return $this->response->json(
            [
                'team' => $this->teamsService->findTeam($team->id),
                'message' => __('The Color has been successfully updated to :item', ['item' => $team->color->value])
            ],
            Response::HTTP_OK,
            [],
            JSON_NUMERIC_CHECK
        );
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
