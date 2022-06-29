<?php

namespace Modules\Dashboard\Http\Controllers;

use App\Repositories\Criteria\EagerLoad;
use App\Repositories\Criteria\GroupBy;
use App\Repositories\Criteria\Latest;
use App\Repositories\Criteria\RegisteredWithinDays;
use App\Repositories\Criteria\Select;
use App\Repositories\Criteria\WhereIsAdmin;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Activities\Repositories\Contracts\ActivitiesRepository;
use Modules\Activities\Transformers\ActivityResource;
use Modules\Categories\Repositories\Contracts\CategoriesRepository;
use Modules\Companies\Repositories\Contracts\CompaniesRepository;
use Modules\Roles\Repositories\Contracts\RolesRepository;
use Modules\Users\Repositories\Contracts\UsersRepository;

class UsersDashboardController extends Controller
{
    public function __construct(private readonly ResponseFactory $response, private readonly UsersRepository $usersRepository, private readonly RolesRepository $rolesRepository, private readonly CompaniesRepository $companiesRepository, private readonly CategoriesRepository $categoriesRepository)
    {
    }

    public function index()
    {
        $result = $this->usersRepository->withCriteria([
            new Select(DB::raw('count(*) as items_count, DATE(created_at) AS date')),
            new RegisteredWithinDays(30),
            new GroupBy('date'),
        ])->get();

        return $this->response->json(['data' => $result], Response::HTTP_OK, [], JSON_NUMERIC_CHECK);
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
