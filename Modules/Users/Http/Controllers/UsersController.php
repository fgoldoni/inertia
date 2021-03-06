<?php

namespace Modules\Users\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\Criteria\EagerLoad;
use App\Repositories\Criteria\OrderBy;
use App\Repositories\Criteria\WhereHas;
use App\Repositories\Criteria\WhereKey;
use App\Repositories\Criteria\WhereLike;
use App\Repositories\Criteria\WhereNot;
use App\Repositories\Criteria\WithTrashed;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Carbon;
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
    public function __construct(
        private readonly UsersRepository $usersRepository,
        private readonly RolesRepository $rolesRepository,
        private readonly Request $request,
        private readonly Redirector $redirect,
        private readonly ResponseFactory $response
    ) {
    }

    public function index(array $modalProps = [])
    {
        request()->validate([
            'direction' => ['in:asc,desc'],
            'field' => ['in:id,name,email'],
        ]);

        Inertia::share('can', fn (Request $request) => $request->user() ? [
            'is_impersonated' => $request->user()->isImpersonated(),
            'create' => $request->user()->can('create', User::class),
            'edit' => $this->request->user()->hasPermissionTo('edit_users'),
            'delete' => $this->request->user()->hasPermissionTo('delete_users'),
        ] : null);

        return Inertia::render('Modules/Users/Index', array_merge([
            'filters' => $this->request->only(['search', 'perPage', 'page', 'field', 'direction']),
            'rowData' => $this->usersRepository->withCriteria([
                new WhereLike(['users.id', 'users.name', 'users.email'], $this->request->get('search')),
                new EagerLoad(['roles:id,name,display_name', 'sessions' => function ($query) {
                    $query->orderBy('last_activity', 'desc')->limit(1);
                }]),
                new WithTrashed(),
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
                    'access' => $user->isAdministrator() ? __('Full') : __('Limited'),
                    'created_at' => $user->created_at?->formatLocalized('%d %B, %Y'),
                    'deleted_at' => $user->deleted_at,
                    'verified' => $user->hasVerifiedEmail(),
                    'can' => [
                        'impersonate' => $this->request->user()->canImpersonate()
                            && $user->canBeImpersonated()
                            && ! $user->trashed(),
                        'delete' => $this->request->user()->hasPermissionTo('edit_users'),
                        'edit' => $this->request->user()->hasPermissionTo('edit_users'),
                    ],
                    'sessions' => $user->sessions->map(function ($session) {
                        $agent = $this->usersRepository->createAgent($session);

                        return (object) [
                            'agent' => [
                                'is_desktop' => $agent->isDesktop(),
                                'platform' => $agent->platform(),
                                'browser' => $agent->browser(),
                            ],
                            'ip_address' => $session->ip_address,
                            'is_current_device' => $session->id === session()->getId(),
                            'last_active' => Carbon::createFromTimestamp($session->last_activity)->diffForHumans(),
                        ];
                    }),
                ]),
        ], $modalProps));
    }

    public function create()
    {
        $this->authorize('create', User::class);

        Inertia::modal('Modules/Users/CreateModal');

        Inertia::basePageRoute(route('admin.users.index', $this->request->only(['search', 'perPage', 'page', 'field', 'direction'])));

        return $this->index([
            'editing' => new UserCollection($this->usersRepository->make([
                'name' => 'test',
                'email' => 'test'.uniqid().'@test.com',
                'phone' => '+4915736795436',
            ])),
        ]);
    }

    public function store(StoreUserRequest $request)
    {
        $user = $this->usersRepository->create(array_merge(
            $request->only('name', 'email', 'phone'),
            [
                'email_verified_at' => now(),
                'password' => bcrypt($request->get('password')),
            ]
        ));

        $user->syncRoles($request->get('role'));

        $this->usersRepository->createTeam($user);

        if ($request->get('invite')) {
            $user->notify(new AdminSendCredentials($request->get('password')));
        }

        return $this->response
            ->json([], Response::HTTP_CREATED, [], JSON_NUMERIC_CHECK)
            ->flash(__(':user successfully added!', ['user' => $user->name]));
    }

    public function show($id)
    {
        return view('users::show');
    }

    public function edit(User $user)
    {
        $this->authorize('edit', $user);

        Inertia::modal('Modules/Users/EditModal');

        Inertia::basePageRoute(route('admin.users.index', $this->request->only(['search', 'perPage', 'page', 'field', 'direction'])));

        return $this->index([
            'editing' => new UserCollection($this->usersRepository->withCriteria([
                new EagerLoad(['roles:id,name,display_name', 'sessions' => function ($query) {
                    $query->orderBy('last_activity', 'desc')->limit(1);
                }]),
                new WithTrashed(),
            ])->find($user->id)),
        ]);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $this->usersRepository->update($user->id, array_merge(
            $request->only('name', 'email', 'phone'),
            $request->has('password') ?
            [
                'password' => bcrypt($request->get('password')),
            ] : []
        ));

        if ($request->get('verified')) {
            $this->usersRepository->update($user->id, ['email_verified_at' => now()]);
        }

        $user->syncRoles($request->get('role'));

        return $this->response
            ->json([], Response::HTTP_CREATED, [], JSON_NUMERIC_CHECK)
            ->flash(__(':user updated successfully.', ['user' => $user->name]));
    }

    public function destroy($selected)
    {
        $items = $this->usersRepository->withCriteria([
            new WhereKey(explode(',', (string) $selected)),
            new WhereNot('users.id', auth()->user()->id),
            new WhereHas('roles', function (Builder $query) {
                $query->whereNot('roles.name', config('app.system.users.roles.administrator'));
            }),
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
            ['message' => __('The User(s) has been successfully deleted')],
            Response::HTTP_OK,
            [],
            JSON_NUMERIC_CHECK
        );
    }

    public function sendEmailVerificationNotification(Request $request, User $user)
    {
        if ($user->hasVerifiedEmail()) {
            return;
        }

        $user->sendEmailVerificationNotification();

        return $this->response
            ->json([], Response::HTTP_OK, [], JSON_NUMERIC_CHECK)
            ->flash(__('The verification link has been successfully sent to :email', ['email' => $user->email]));
    }

    public function restore(int $id)
    {
        $user = $this->usersRepository->withCriteria([
            new WithTrashed(),
        ])->restore($id);

        return $this->response->json(
            ['message' => __('The User (:item) has been successfully updated', ['item' => $user->name])],
            Response::HTTP_OK,
            [],
            JSON_NUMERIC_CHECK
        );
    }
}
