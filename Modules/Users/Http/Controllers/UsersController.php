<?php
namespace Modules\Users\Http\Controllers;

use App\Models\User;
use App\Repositories\Criteria\Select;
use App\Repositories\Criteria\WhereLike;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Modules\Roles\Repositories\Contracts\RolesRepository;
use Modules\Users\Http\Requests\StoreUserRequest;
use Modules\Users\Http\Requests\UpdateUserRequest;
use Modules\Users\Repositories\Contracts\UsersRepository;

class UsersController extends Controller
{
    /**
     * @var \Illuminate\Http\Request
     */
    private Request $request;
    /**
     * @var \Illuminate\Routing\Redirector
     */
    private Redirector $redirect;

    public function __construct(private readonly UsersRepository $usersRepository, private readonly RolesRepository $rolesRepository, Request $request, Redirector $redirect)
    {
        $this->request = $request;
        $this->redirect = $redirect;
    }

    public function index(array $modalProps = [])
    {
        return Inertia::render('Modules/Users/Index', array_merge([
            'filters' => $this->request->only(['search', 'perPage']),
            'users' => $this->usersRepository->withCriteria([
                new WhereLike(['users.id', 'users.name', 'users.email'], $this->request->get('search'))
            ])->paginate()
                ->withQueryString()
                ->through(fn ($user) => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                ]),
        ], $modalProps));
    }

    public function create()
    {
        Inertia::modal('Modules/Users/CreateModal');

        return $this->index();
    }

    public function store(StoreUserRequest $request)
    {
        $user = $this->usersRepository->update(array_merge(
            $request->only('name', 'email'),
            [
                'email_verified_at' => now(),
                'password' => bcrypt('00000000'),
                'api_token' => Str::random(60)
            ]
        ));

        $user->assignRole(config('app.system.users.roles.default'));

        return $this->redirect->route('users')->with('flash', 'User created.');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('users::show');
    }

    public function edit(User $user)
    {
        Inertia::modal('Modules/Users/EditModal');

        return $this->index([
            'editing' => $user->load('roles:id'),
            'roles' => $this->rolesRepository->withCriteria([
                new Select('roles.id', 'roles.name', 'roles.display_name')
            ])->all(),
        ]);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $this->usersRepository->update($user->id, $request->only('name', 'email'));

        $user->syncRoles($request->get('role_id'));

        return $this->redirect->route('admin.users.index')->banner('User created.');
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
