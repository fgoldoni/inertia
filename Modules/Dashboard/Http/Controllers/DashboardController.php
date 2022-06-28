<?php
namespace Modules\Dashboard\Http\Controllers;

use App\Repositories\Criteria\EagerLoad;
use App\Repositories\Criteria\Where;
use App\Repositories\Criteria\WhereHas;
use App\Repositories\Criteria\WhereRelation;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Routing\Redirector;
use Inertia\Inertia;
use Modules\Dashboard\Repositories\Contracts\DashboardRepository;
use Modules\Users\Repositories\Contracts\UsersRepository;

class DashboardController extends Controller
{
    public function __construct(private readonly DashboardRepository $dashboardRepository, private readonly UsersRepository $usersRepository, private readonly ResponseFactory $response, private readonly Redirector $redirect)
    {
    }

    public function index(Request $request)
    {
        return Inertia::render('Modules/Dashboard/Index', [
            'filters' => $request->only(['search', 'perPage', 'page', 'field', 'direction']),
            'rowData' => $this->usersRepository->withCriteria([
                new Where('id', auth()->user()->id),
            ])->first()->dashboards()->get(),
        ]);
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
     * @param Request $request
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

    /**
     * Update the specified resource in storage.
     * @param Request $request
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
