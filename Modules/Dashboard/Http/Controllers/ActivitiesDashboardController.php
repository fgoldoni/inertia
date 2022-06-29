<?php

namespace Modules\Dashboard\Http\Controllers;

use App\Repositories\Criteria\EagerLoad;
use App\Repositories\Criteria\Latest;
use App\Repositories\Criteria\WhereIsAdmin;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Activities\Repositories\Contracts\ActivitiesRepository;
use Modules\Activities\Transformers\ActivityResource;
use Modules\Categories\Repositories\Contracts\CategoriesRepository;
use Modules\Companies\Repositories\Contracts\CompaniesRepository;
use Modules\Jobs\Repositories\Contracts\JobsRepository;
use Modules\Roles\Repositories\Contracts\RolesRepository;

class ActivitiesDashboardController extends Controller
{
    public function __construct(private readonly ResponseFactory $response, private readonly ActivitiesRepository $activitiesRepository, private readonly RolesRepository $rolesRepository, private readonly CompaniesRepository $companiesRepository, private readonly CategoriesRepository $categoriesRepository)
    {
    }

    public function index()
    {
        $result = ActivityResource::collection($this->activitiesRepository->withCriteria([
            new EagerLoad(['causer']),
            new Latest(),
            new WhereIsAdmin('causer_id', auth()->user()->id),
        ])->get());

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
