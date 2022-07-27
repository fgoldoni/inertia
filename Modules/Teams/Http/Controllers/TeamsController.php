<?php
namespace Modules\Teams\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Repositories\Criteria\EagerLoad;
use App\Repositories\Criteria\Has;
use App\Repositories\Criteria\OrderBy;
use App\Repositories\Criteria\Where;
use App\Repositories\Criteria\WhereHas;
use App\Repositories\Criteria\WhereKey;
use App\Repositories\Criteria\WhereLike;
use App\Repositories\Criteria\WhereWithoutAdmin;
use App\Repositories\Criteria\WithTrashed;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Laravel\Jetstream\Jetstream;
use Modules\Activities\Repositories\Contracts\ActivitiesRepository;
use Modules\Attachments\Repositories\Contracts\AttachmentsRepository;
use Modules\Categories\Repositories\Contracts\CategoriesRepository;
use Modules\Jobs\Entities\Job;
use Modules\Jobs\Transformers\JobResource;
use Modules\Teams\Http\Requests\StoreTeamRequest;
use Modules\Teams\Http\Requests\UpdateTeamRequest;
use Modules\Teams\Repositories\Contracts\TeamsRepository;
use Modules\Teams\Services\Contracts\TeamsServiceInterface;
use Modules\Teams\Transformers\TeamResource;

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

        $teams = $this->teamsRepository->withCriteria([
            new EagerLoad(['owner:id,name,email,profile_photo_path', 'users']),
            new OrderBy($this->request->get('field', ''), $this->request->get('direction')),
            new WhereLike(
                ['teams.id', 'teams.name', 'teams.display_name', 'teams.subdomain'],
                $this->request->get('search')
            ),
            new WhereWithoutAdmin('teams.user_id', auth()->user()->id),
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

        return Inertia::render('Modules/Teams/Index', array_merge([
            'filters' => $this->request->only(['search', 'perPage', 'page', 'field', 'direction']),
            'rowData' => $teams,
        ], $modalProps));
    }

    public function create(Request $request)
    {
        $this->authorize('create', Team::class);

        Inertia::modal('Modules/Teams/CreateModal');

        Inertia::basePageRoute(
            route(
                'admin.teams.index',
                $this->request->only(['search', 'perPage', 'page', 'field', 'direction'])
            )
        );

        return $this->index([#
            'availableRoles' => array_values(Jetstream::$roles),
            'editing' => [
                'id' => null,
                'name' => '',
                'display_name' => '',
                'subdomain' => '',
                'teamInvitations' => [],
                'avatar_path' => '',
                'attachments' => [],
                'members' => [],
                'industries' => $this->categoriesRepository->industries(['id', 'name']),
                'categories' => [],
                'color' => 'teal',

                'logs' => [],
                'colors' => $this->teamsService->colors(),
            ]
        ]);
    }


    public function store(StoreTeamRequest $request)
    {
        $team = $this->teamsService->create(
            $request->only(
                'name',
                'display_name',
                'subdomain'
            ),
        );

        $this->teamsRepository->sync($team->id, 'categories', array_merge(
            $request->only('industry'),
        ));

        return $this->response->json(
            [
                'team' => $this->teamsService->findTeam($team->id),
                'message' => __('The Team (:item) has been successfully created', ['item' => $team->name])
            ],
            Response::HTTP_OK,
            [],
            JSON_NUMERIC_CHECK
        );
    }

    public function show($id)
    {
        return view('teams::show');
    }

    public function edit(Request $request, Team $team)
    {
        $this->authorize('update', $team);

        Inertia::modal('Modules/Teams/EditModal');

        Inertia::basePageRoute(
            route('admin.teams.index', $this->request->only(['search', 'perPage', 'page', 'field', 'direction']))
        );

        return $this->index([
            'editing' => $this->teamsService->findTeam($team->id),
            'availableRoles' => array_values(Jetstream::$roles),
            'permissions' => [
                'canAddTeamMembers' => Gate::check('addTeamMember', $team),
                'canDeleteTeam' => Gate::check('delete', $team),
                'canRemoveTeamMembers' => Gate::check('removeTeamMember', $team),
                'canUpdateTeam' => Gate::check('update', $team),
            ],
        ]);
    }

    public function update(UpdateTeamRequest $request, Team $team)
    {
        $team = $this->teamsRepository
            ->update($team->id, $request->only('name', 'display_name', 'subdomain'));

        $this->teamsRepository->sync($team->id, 'categories', array_merge(
            $request->only('industry'),
        ));

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

    public function destroy($selected)
    {
        $items = $this->teamsRepository->withCriteria([
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
            ['message' => __('The Team(s) has been successfully deleted')],
            Response::HTTP_OK,
            [],
            JSON_NUMERIC_CHECK
        );
    }

    public function restore(int $id)
    {
        $job = $this->teamsRepository->withCriteria([
            new WithTrashed(),
        ])->restore($id);

        return $this->response->json(
            ['message' => __('The Team (:item) has been successfully restored', ['item' => $team->name])],
            Response::HTTP_OK,
            [],
            JSON_NUMERIC_CHECK
        );
    }
}
