<?php
namespace Modules\Roles\Http\Controllers\Api;

use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Roles\Repositories\Contracts\PermissionsRepository;

class PermissionsController extends Controller
{
    public function __construct(private readonly ResponseFactory $response, private readonly PermissionsRepository $permissionsRepository)
    {
    }

    public function index()
    {
        return $this->response->json(['data' => $this->permissionsRepository->all(['id', 'name', 'display_name', 'group_name'])->groupByName()], Response::HTTP_OK, [], JSON_NUMERIC_CHECK);
    }

    public function store(Request $request)
    {
    }

    public function show($id)
    {
    }

    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {
    }
}
