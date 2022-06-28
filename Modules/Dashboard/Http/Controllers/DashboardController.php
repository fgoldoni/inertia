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


    public function create()
    {
        return view('dashboard::create');
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        return view('dashboard::show');
    }


    public function edit($id)
    {
        return view('dashboard::edit');
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
