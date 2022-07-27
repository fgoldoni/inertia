<?php

namespace Modules\Users\Http\Controllers;

use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Laravel\Jetstream\Jetstream;
use Modules\Teams\Repositories\Contracts\TeamsRepository;
use Modules\Users\Http\Requests\LinkApiTokenRequest;
use Modules\Users\Http\Requests\StoreApiTokenRequest;
use Modules\Users\Repositories\Contracts\UsersRepository;
use Symfony\Component\HttpFoundation\Response;

class ApiTokenController extends Controller
{
    public function __construct(
        private readonly UsersRepository $usersRepository,
        private readonly TeamsRepository $teamsRepository,
        private readonly ResponseFactory $response
    ) {
    }

    public function index()
    {
        return view('users::index');
    }

    public function create()
    {
        return view('users::create');
    }

    public function store(StoreApiTokenRequest $request)
    {
        $user = $this->usersRepository->findWhereFirst('email', $request->email);

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $user->createToken(
            $user->name,
            Jetstream::$defaultPermissions
        );

        return $this->response->json(
            ['accessToken' => $token->plainTextToken],
            Response::HTTP_CREATED,
            [],
            JSON_NUMERIC_CHECK
        )->cookie('accessToken', $token->plainTextToken, 60 * 60);
    }

    public function loginLink(LinkApiTokenRequest $request)
    {
        $team = $this->teamsRepository->teamFromHost($request->get('host'));

        if ($this->usersRepository->isExist($request->email)) {
            $user = $this->usersRepository->findWhereFirst('email', $request->email);
        } else {
            $user = $this->usersRepository->create(array_merge(
                $request->only('email'),
                [
                    'name' => "{$team->display_name} User",
                    'email_verified_at' => now(),
                    'password' => bcrypt(Str::random(8)),
                ]
            ));

            $user->syncRoles(config('app.system.users.roles.default'));
        }

        $token = $this->usersRepository->createToken($user);

        $this->teamsRepository->attachUser($team, $user);

        $this->usersRepository->sendLoginLink($team, $user, $token, $request->get('host'));

        return $this->response->json(
            ['message' => __('We have e-mailed your login link on :email.', ['email' => $user->email])],
            Response::HTTP_OK,
            [],
            JSON_NUMERIC_CHECK
        );
    }

    public function show($id)
    {
        return view('users::show');
    }

    public function edit($id)
    {
        return view('users::edit');
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
