<?php
namespace Modules\Dashboard\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Routing\Redirector;
use Modules\Dashboard\Http\Requests\UpdateDashboardUserRequest;
use Modules\Dashboard\Repositories\Contracts\DashboardUserRepository;
use Modules\Users\Repositories\Contracts\UsersRepository;

class DashboardUserController extends Controller
{
    public function __construct(private readonly DashboardUserRepository $dashboardUserRepository, private readonly UsersRepository $usersRepository, private readonly ResponseFactory $response, private readonly Redirector $redirect)
    {
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('dashboard::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('dashboard::create');
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
        return view('dashboard::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('dashboard::edit');
    }

    public function update(UpdateDashboardUserRequest $request, User $user)
    {
        foreach ($request->get('layouts') as $layout) {
            $this->dashboardUserRepository->update($layout['id'], [
                'x' => $layout['x'],
                'y' => $layout['y'],
                'w' => $layout['w'],
                'h' => $layout['h'],
            ]);
        }

        return $this->response->json(['message' => __('The Dashboard (:item) has been successfully updated', ['item' => 'sad'])], Response::HTTP_OK, [], JSON_NUMERIC_CHECK);
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
