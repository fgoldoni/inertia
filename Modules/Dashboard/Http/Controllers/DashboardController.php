<?php
namespace Modules\Dashboard\Http\Controllers;

use App\Repositories\Criteria\ByUser;
use App\Repositories\Criteria\Where;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Routing\Redirector;
use Inertia\Inertia;
use Modules\Companies\Repositories\Contracts\CompaniesRepository;
use Modules\Dashboard\Repositories\Contracts\DashboardRepository;
use Modules\Jobs\Repositories\Contracts\JobsRepository;
use Modules\Users\Repositories\Contracts\UsersRepository;

class DashboardController extends Controller
{
    public function __construct(
        private readonly DashboardRepository $dashboardRepository,
        private readonly JobsRepository $jobsRepository,
        private readonly CompaniesRepository $companiesRepository,
        private readonly UsersRepository $usersRepository,
        private readonly ResponseFactory $response,
        private readonly Redirector $redirect
    ) {
    }

    public function index(Request $request)
    {
        return Inertia::render('Modules/Dashboard/Index', [
            'filters' => $request->only(['search', 'perPage', 'page', 'field', 'direction']),
            'rowData' => $this->usersRepository->withCriteria([
                new Where('id', auth()->user()->id),
            ])->first()->dashboards()->get(),
            'data' => [
                'jobs' => $this->jobsRepository->withCriteria([
                    new ByUser(auth()->user()->id),
                ])->count(),
                'companies' => $this->companiesRepository->withCriteria([
                    new ByUser(auth()->user()->id),
                ])->count(),
            ]
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
