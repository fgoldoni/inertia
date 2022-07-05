<?php

namespace Modules\Teams\Http\Controllers;

use App\Models\Team;
use App\Repositories\Criteria\EagerLoad;
use App\Repositories\Criteria\Has;
use App\Repositories\Criteria\OrderBy;
use App\Repositories\Criteria\Select;
use App\Repositories\Criteria\WhereLike;
use App\Repositories\Criteria\WithTrashed;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Routing\Redirector;
use Inertia\Inertia;
use Modules\Activities\Repositories\Contracts\ActivitiesRepository;
use Modules\Attachments\Repositories\Contracts\AttachmentsRepository;
use Modules\Categories\Repositories\Contracts\CategoriesRepository;
use Modules\Companies\Repositories\Contracts\CompaniesRepository;
use Modules\Jobs\Entities\Job;
use Modules\Jobs\Repositories\Contracts\JobsRepository;
use Modules\Roles\Repositories\Contracts\RolesRepository;
use Modules\Teams\Repositories\Contracts\TeamsRepository;
use Modules\Teams\Transformers\TeamResource;

class TeamsController extends Controller
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

    public function index(array $modalProps = [])
    {
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
