<?php

namespace Modules\Teams\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Gate;
use Laravel\Jetstream\TeamInvitation;
use Modules\Activities\Repositories\Contracts\ActivitiesRepository;
use Modules\Attachments\Repositories\Contracts\AttachmentsRepository;
use Modules\Categories\Repositories\Contracts\CategoriesRepository;
use Modules\Teams\Repositories\Contracts\TeamsRepository;

class TeamInvitationController extends Controller
{
    public function __construct(
        private readonly TeamsRepository $teamsRepository,
        private readonly ActivitiesRepository $activitiesRepository,
        private readonly AttachmentsRepository $attachmentsRepository,
        private readonly CategoriesRepository $categoriesRepository,
        private readonly ResponseFactory $response,
        private readonly Request $request,
        private readonly Redirector $redirect
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

    public function destroy(Request $request, TeamInvitation $invitation)
    {
        $this->authorize('removeTeamMember', $invitation->team);

        $invitation->delete();

        return $this->response->json(
            ['message' => __('The Invitation has been successfully canceled')],
            Response::HTTP_OK,
            [],
            JSON_NUMERIC_CHECK
        );
    }
}
