<?php
namespace Modules\Users\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use App\Repositories\Criteria\EagerLoad;
use App\Repositories\Criteria\OrderBy;
use App\Repositories\Criteria\Select;
use App\Repositories\Criteria\Where;
use App\Repositories\Criteria\WhereLike;
use App\Repositories\Criteria\WhereNot;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Modules\Roles\Repositories\Contracts\RolesRepository;
use Modules\Users\Http\Requests\StoreUserRequest;
use Modules\Users\Http\Requests\UpdateUserRequest;
use Modules\Users\Notifications\AdminSendCredentials;
use Modules\Users\Repositories\Contracts\UsersRepository;
use Modules\Users\Transformers\UserCollection;
use Symfony\Component\HttpFoundation\Response;

class UsersController extends Controller
{
    public function __construct(private readonly UsersRepository $usersRepository, private readonly RolesRepository $rolesRepository, private readonly Request $request, private readonly Redirector $redirect, private readonly ResponseFactory $response) {}

    public function index(array $modalProps = [])
    {
        request()->validate([
            'direction' => ['in:asc,desc'],
            'field' => ['in:id,name,email']
        ]);

        return Inertia::render('Modules/Users/Index', array_merge([
            'filters' => $this->request->only(['search', 'perPage', 'page', 'field', 'direction']),
            'users' => $this->usersRepository->withCriteria([
                new WhereLike(['users.id', 'users.name', 'users.email'], $this->request->get('search')),
                new EagerLoad(['roles:id,name,display_name']),
                new OrderBy($this->request->get('field', ''), $this->request->get('direction')),
            ])->paginate()
                ->withQueryString()
                ->through(fn ($user) => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'phone' => $user->phone,
                    'image' => $user->profile_photo_url,
                    'role' => $user->roles->value('display_name'),
                    'isAdministrator' => $user->isAdministrator(),
                    'access' => $user->hasRole(config('app.system.users.roles.administrator')) ? __('Full') : __('Limited'),
                    'created_at' => $user->created_at?->formatLocalized('%d %B, %Y'),
                    'verified' => $user->hasVerifiedEmail(),
                ]),
        ], $modalProps));
    }

    public function create()
    {
        Inertia::modal('Modules/Users/CreateModal');

        return $this->index([
            'editing' => new UserCollection($this->usersRepository->make([
                'name' => 'test',
                'email' => 'test' . uniqid() . '@test.com',
                'phone' => '+4915736795436',
            ])),
            'roles' => $this->rolesRepository->withCriteria([
                new Select('roles.id', 'roles.name', 'roles.display_name'),
                new WhereNot('roles.name', config('app.system.users.roles.default'))
            ])->all(),
        ]);
    }

    public function store(StoreUserRequest $request)
    {
        $user = $this->usersRepository->create(array_merge(
            $request->only('name', 'email', 'phone'),
            [
                'email_verified_at' => now(),
                'password' => bcrypt($request->get('password')),
                'api_token' => Str::random(60)
            ]
        ));

        $user->syncRoles($request->get('role'));

        $this->usersRepository->createTeam($user);

        if ($request->get('invite')) {
            $user->notify(new AdminSendCredentials($request->get('password')));
        }

        return $this->response->json(['message' => __(':user created successfully.', ['user' => $user->name])], Response::HTTP_CREATED, [], JSON_NUMERIC_CHECK);
    }


    public function show($id)
    {
        return view('users::show');
    }

    public function edit(User $user)
    {
        Inertia::modal('Modules/Users/EditModal');

        return $this->index([
            'editing' => new UserCollection($user->load('roles:id')),
            'roles' => $this->rolesRepository->withCriteria([
                new Select('roles.id', 'roles.name', 'roles.display_name')
            ])->all(),
        ]);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $this->usersRepository->update($user->id, array_merge(
            $request->only('name', 'email', 'phone'),
            [
                'password' => bcrypt($request->get('password')),
            ]
        ));

        if ($request->get('verified')) {
            $this->usersRepository->update($user->id,  ['email_verified_at' => now()]);
        }

        $user->syncRoles($request->get('role'));

        return $this->response->json(['message' => __(':user updated successfully.', ['user' => $user->name])], Response::HTTP_CREATED, [], JSON_NUMERIC_CHECK);
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


    public function sendEmailVerificationNotification(User $user)
    {
        if ($user->hasVerifiedEmail()) {
            return;
        }

        $user->sendEmailVerificationNotification();

        return $this->response->json(['message' =>__('Verification link sent!')], Response::HTTP_OK, [], JSON_NUMERIC_CHECK);
    }
}
