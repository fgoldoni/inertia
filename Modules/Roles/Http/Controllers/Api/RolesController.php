<?php
namespace Modules\Roles\Http\Controllers\Api;

use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Roles\Repositories\Contracts\RolesRepository;

class RolesController extends Controller
{
    public function __construct(private readonly ResponseFactory $response, private readonly RolesRepository $roles)
    {
    }

    public function index()
    {

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
        //
    }
}
