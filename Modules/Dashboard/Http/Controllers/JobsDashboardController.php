<?php
namespace Modules\Dashboard\Http\Controllers;

use App\Repositories\Criteria\ByUser;
use App\Repositories\Criteria\GroupBy;
use App\Repositories\Criteria\Select;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Categories\Repositories\Contracts\CategoriesRepository;
use Modules\Companies\Repositories\Contracts\CompaniesRepository;
use Modules\Jobs\Repositories\Contracts\JobsRepository;
use Modules\Roles\Repositories\Contracts\RolesRepository;

class JobsDashboardController extends Controller
{
    public function __construct(private readonly ResponseFactory $response, private readonly JobsRepository $jobsRepository, private readonly RolesRepository $rolesRepository, private readonly CompaniesRepository $companiesRepository, private readonly CategoriesRepository $categoriesRepository)
    {
    }

    public function index()
    {
        $result = $this->jobsRepository->withCriteria([
            new Select(DB::raw('count(*) as items_count, DATE(closing_to) AS date')),
            new GroupBy('date'),
            new ByUser(auth()->user()->id),
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
