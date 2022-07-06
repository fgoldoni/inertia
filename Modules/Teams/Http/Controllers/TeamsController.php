<?php
namespace Modules\Teams\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Repositories\Criteria\EagerLoad;
use App\Repositories\Criteria\WithTrashed;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Inertia\Inertia;
use Laravel\Jetstream\Jetstream;
use Modules\Activities\Repositories\Contracts\ActivitiesRepository;
use Modules\Attachments\Repositories\Contracts\AttachmentsRepository;
use Modules\Categories\Repositories\Contracts\CategoriesRepository;
use Modules\Teams\Http\Requests\UpdateTeamRequest;
use Modules\Teams\Repositories\Contracts\TeamsRepository;
use Modules\Teams\Services\Contracts\TeamsServiceInterface;

class TeamsController extends Controller
{
    public function __construct(
        private readonly TeamsRepository $teamsRepository,
        private readonly TeamsServiceInterface $teamsService,
        private readonly ActivitiesRepository $activitiesRepository,
        private readonly AttachmentsRepository $attachmentsRepository,
        private readonly CategoriesRepository $categoriesRepository,
        private readonly ResponseFactory $response,
        private readonly Request $request,
        private readonly Redirector $redirect
    ) {
    }

    public function index(array $modalProps = [])
    {
        $this->authorize('viewAny', Team::class);

        Inertia::share('can', fn (Request $request) => $request->user() ? [
            'is_impersonated' => $request->user()->isImpersonated(),
            'create' => $request->user()->can('create', Team::class),
            'edit' => $this->request->user()->hasPermissionTo('edit_teams'),
            'delete' => $this->request->user()->hasPermissionTo('delete_teams'),
        ] : null);

        $paginator = $this->teamsRepository->withCriteria([
            new EagerLoad(['owner:id,name,email,profile_photo_path', 'users']),
            new WithTrashed(),
        ])->paginate()
            ->withQueryString()
            ->through(fn ($team) => [
                'id' => $team->id,
                'name' => $team->name,
                'display_name' => $team->display_name,
                'owner' => $team->owner?->name,
                'avatar_url' => $team->avatar_url,
                'ownsTeam' => auth()->user()->ownsTeam($team),
                'belongsToTeam' => auth()->user()->belongsToTeam($team),
                'isCurrentTeam' => auth()->user()->isCurrentTeam($team),
                'members' => $team->allUsers(),
                'subdomain' => $team->subdomain,
                'created_at' => $team->created_at,
                'updated_at' => $team->updated_at,
                'deleted_at' => $team->deleted_at,
            ]);

        if (!auth()->user()->isAdministrator()) {
            $teams = $paginator->getCollection();

            $filteredCollection = $teams->filter(fn ($team) => $team['belongsToTeam']);

            $paginator->setCollection($filteredCollection);
        }

        return Inertia::render('Modules/Teams/Index', array_merge([
            'filters' => $this->request->only(['search', 'perPage', 'page', 'field', 'direction']),
            'rowData' => $paginator,
        ], $modalProps));
    }

    public function create()
    {
        $this->authorize('create', Team::class);

        return view('teams::create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        return view('teams::show');
    }

    public function edit(Request $request, Team $team)
    {
        $this->authorize('view', $team);

        Inertia::modal('Modules/Teams/EditModal');

        Inertia::basePageRoute(
            route('admin.teams.index', $this->request->only(['search', 'perPage', 'page', 'field', 'direction']))
        );

        return $this->index([
            'editing' => $this->teamsService->findTeam($team->id),
            'availableRoles' => array_values(Jetstream::$roles),
        ]);
    }

    public function update(UpdateTeamRequest $request, Team $team)
    {
        $team = $this->teamsRepository
            ->update($team->id, $request->only('name', 'display_name', 'subdomain'));

        return $this->response->json(
            [
                'team' => $this->teamsService->findTeam($team->id),
                'message' => __('The Company (:item) has been successfully updated', ['item' => $team->name])
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
