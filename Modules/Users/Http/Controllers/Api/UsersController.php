<?php

namespace Modules\Users\Http\Controllers\Api;

use App\Repositories\Criteria\EagerLoad;
use App\Repositories\Criteria\Limit;
use App\Repositories\Criteria\OrderBy;
use App\Repositories\Criteria\WhereLike;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Roles\Repositories\Contracts\PermissionsRepository;
use Modules\Users\Repositories\Contracts\UsersRepository;

class UsersController extends Controller
{
    public function __construct(private readonly ResponseFactory $response, private readonly UsersRepository $usersRepository, private readonly Request $request)
    {
    }

    public function index()
    {
        $data = $this->usersRepository->withCriteria([
            new WhereLike(['users.id', 'users.name', 'users.email'], $this->request->get('search')),
            new Limit(10)
        ])->get(['id', 'name', 'email', 'profile_photo_path']);

        return $this->response->json(['data' => $data], Response::HTTP_OK, [], JSON_NUMERIC_CHECK);
    }

    /**
     * Store a newly created resource in storage.
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
