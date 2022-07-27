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
use Modules\Roles\Http\Requests\StoreRoleRequest;
use Modules\Roles\Http\Requests\UpdateRoleRequest;
use Modules\Roles\Repositories\Contracts\PermissionsRepository;
use Modules\Roles\Repositories\Contracts\RolesRepository;
use Modules\Roles\Transformers\RoleResource;

class RolesController extends Controller
{
    public function __construct(
        private readonly RolesRepository $rolesRepository,
        private readonly PermissionsRepository $permissionsRepository,
        private readonly ResponseFactory $response
    ) {
    }

    public function index(array $modalProps = [])
    {
        return Inertia::render('Modules/Roles/Index', array_merge([
            'rowData' => $this->rolesRepository->withCriteria([
                new WithCount(['users']),
                new EagerLoad(['users']),
            ])
                    ->get()
                    ->map(fn ($role) => [
                        'id' => $role->id,
                        'name' => $role->name,
                        'display_name' => $role->display_name,
                        'can_be_removed' => $role->can_be_removed,
                        'access' => $role->isAdministrator() ? __('Full') : __('Limited'),
                        'permissions_count' => $role->permissions_count,
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

        Inertia::basePageRoute(route('admin.roles.index'));

        return $this->index([
            'editing' => new RoleResource($this->rolesRepository->make([
                'id' => null,
                'name' => 'test',
                'display_name' => 'test',
            ])),
        ]);
    }

    public function store(StoreRoleRequest $request)
    {
        $role = $this->rolesRepository->create($request->only('name', 'display_name'));

        $role->syncPermissions($request->get('permissions'));

        $this->rolesRepository->sync($role->id, 'users', $request->get('users'));

        return $this->response
            ->json([], Response::HTTP_CREATED, [], JSON_NUMERIC_CHECK)
            ->flash(__(':role successfully added!', ['role' => $role->display_name]));
    }

    public function show($id)
    {
        return view('roles::show');
    }

    public function edit(Request $request, Role $role)
    {
        Inertia::modal('Modules/Roles/EditModal');

        Inertia::basePageRoute(route('admin.roles.index'));

        return $this->index([
            'editing' => new RoleResource($this->rolesRepository->withCriteria([
                new WithCount(['users']),
                new EagerLoad(['users' => fn ($query) => $query->select('id', 'name', 'email', 'profile_photo_path')->orderBy('name'), 'permissions']),
            ])->find($role->id)),
        ]);
    }

    public function update(UpdateRoleRequest $request, Role $role)
    {
        $this->rolesRepository->update($role->id, $request->only('name', 'display_name'));

        $role->syncPermissions($request->get('permissions'));

        $this->rolesRepository->sync($role->id, 'users', $request->get('users'));

        return $this->response
            ->json([], Response::HTTP_CREATED, [], JSON_NUMERIC_CHECK)
            ->flash(__(
                'Permission(s) :permission has been given to this role.',
                ['permission' => implode(',', $request->get('permissions'))]
            ));
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
