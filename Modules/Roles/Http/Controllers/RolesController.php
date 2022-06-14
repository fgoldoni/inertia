<?php
namespace Modules\Roles\Http\Controllers;

use App\Repositories\Criteria\EagerLoad;
use App\Repositories\Criteria\WithCount;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Inertia\Inertia;
use Modules\Roles\Entities\Role;
use Modules\Roles\Repositories\Contracts\PermissionsRepository;
use Modules\Roles\Repositories\Contracts\RolesRepository;
use Modules\Roles\Transformers\PermissionResource;
use Modules\Roles\Transformers\RoleResource;

class RolesController extends Controller
{
    public function __construct(private readonly RolesRepository $rolesRepository, private readonly PermissionsRepository $permissionsRepository, private readonly ResponseFactory $response)
    {
    }

    public function index(array $modalProps = [])
    {
        return Inertia::render('Modules/Roles/Index', array_merge([
            'filters' => [],
            'permissions' => PermissionResource::collection($this->permissionsRepository->all())->groupBy('group_name'),
            'roles' => $this->rolesRepository->withCriteria([
                new WithCount('users'),
                new EagerLoad(['users']),
            ])->get()
                ->map(fn ($role) => [
                    'id' => $role->id,
                    'name' => $role->name,
                    'display_name' => $role->display_name,
                    'can_be_removed' => $role->can_be_removed,
                    'users_count' => $role->users_count,
                    'users' => $role->users->map(fn ($user) => [
                        'id' => $user->id,
                        'name' => $user->name,
                        'image' => $user->profile_photo_url,
                    ])->take(6),
                ]),
        ], $modalProps));
    }

    public function create(Request $request)
    {
        Inertia::modal('Modules/Roles/CreateModal');

        Inertia::basePageRoute(route('admin.roles.index', $request->only(['search', 'perPage', 'page', 'field', 'direction'])));

        return $this->index([
            'editing' => $this->rolesRepository->make([
                'name' => 'test',
            ]),
            'permissions' => [],
        ]);
    }

    /**
     * Store a newly created resource in storage.
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
        return view('roles::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Request $request, Role $role)
    {
        Inertia::modal('Modules/Roles/EditModal');

        Inertia::basePageRoute(route('admin.roles.index', $request->only(['search', 'perPage', 'page', 'field', 'direction'])));

        return $this->index([
            'editing' => new RoleResource($role->loadCount(['users'])->load(['users', 'permissions'])),
        ]);
    }


    public function update(Request $request, Role $role)
    {
        $this->rolesRepository->update($role->id, $request->only('name', 'display_name'));

        $role->syncPermissions($request->get('permissions'));

        return $this->response
            ->json([], Response::HTTP_CREATED, [], JSON_NUMERIC_CHECK)
            ->flash(__('Permission(s) :permission has been given to this role.', ['permission' => implode(',', $request->get('permissions'))]));
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
