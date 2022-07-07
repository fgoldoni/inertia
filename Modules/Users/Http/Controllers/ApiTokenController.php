<?php
namespace Modules\Users\Http\Controllers;

use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Laravel\Jetstream\Jetstream;
use Modules\Users\Http\Requests\LinkApiTokenRequest;
use Modules\Users\Http\Requests\StoreApiTokenRequest;
use Modules\Users\Repositories\Contracts\UsersRepository;
use Symfony\Component\HttpFoundation\Response;

class ApiTokenController extends Controller
{
    public function __construct(
        private readonly UsersRepository $usersRepository,
        private readonly ResponseFactory $response
    ) {
    }

    public function index()
    {
        return view('users::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('users::create');
    }

    public function store(StoreApiTokenRequest $request)
    {
        $user = $this->usersRepository->findWhereFirst('email', $request->email);

        if (!$user || !Hash::check($request->password, $user->password)) {
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

    public function link(LinkApiTokenRequest $request)
    {

        if ($this->usersRepository->isExist($request->email)) {
            $user = $this->usersRepository->findWhereFirst('email', $request->email);

            $token = $user->createToken(
                $user->name,
                Jetstream::$defaultPermissions
            );

            $this->usersRepository->sendLoginLink($user, $token, $request->get('host'));
        }

        return $this->response->json(
            ['message' => __('We have e-mailed your login link!')],
            Response::HTTP_OK,
            [],
            JSON_NUMERIC_CHECK
        );
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

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('users::edit');
    }

    /**
     * Update the specified resource in storage.
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
