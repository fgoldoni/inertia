<?php

namespace Modules\Dashboard\Http\Controllers;

use App\Repositories\Criteria\ByUser;
use App\Repositories\Criteria\EagerLoad;
use App\Repositories\Criteria\GroupBy;
use App\Repositories\Criteria\Latest;
use App\Repositories\Criteria\RegisteredWithinDays;
use App\Repositories\Criteria\Select;
use App\Repositories\Criteria\WhereIsAdmin;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Modules\Activities\Repositories\Contracts\ActivitiesRepository;
use Modules\Activities\Transformers\ActivityResource;
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
        private readonly ActivitiesRepository $activitiesRepository,
        private readonly UsersRepository $usersRepository,
        private readonly ResponseFactory $response,
        private readonly Redirector $redirect
    ) {
    }

    public function index(Request $request)
    {
        return Inertia::render('Modules/Dashboard/Index', [
            'filters' => $request->only(['search', 'perPage', 'page', 'field', 'direction']),
            'rowData' => auth()->user()->dashboards()->get(),
            'data' => [
                'jobs_count' => $this->jobsRepository->withCriteria([
                ])->count(),
                'companies_count' => $this->companiesRepository->withCriteria([
                    new ByUser(auth()->user()->id),
                ])->count(),
            ],
        ]);
    }

    public function loadData()
    {
        $result = [];
        $result['activities'] = ActivityResource::collection($this->activitiesRepository->withCriteria([
            new EagerLoad(['causer']),
            new Latest(),
            new WhereIsAdmin('causer_id', auth()->user()->id),
        ])->get());

        $result['users'] = $this->usersRepository->withCriteria([
            new Select(DB::raw('count(*) as items_count, DATE(created_at) AS date')),
            new RegisteredWithinDays(30),
            new GroupBy('date'),
        ])->get();

        $result['jobs'] = $this->jobsRepository->withCriteria([
            new Select(DB::raw('count(*) as items_count, DATE(closing_to) AS date')),
            new GroupBy('date'),
        ])->get();

        return $this->response->json(['data' => $result], Response::HTTP_OK, [], JSON_NUMERIC_CHECK);
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
