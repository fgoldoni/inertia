<?php

namespace Modules\Jobs\Http\Controllers\Api;

use App\Models\User;
use App\Repositories\Criteria\ByUser;
use App\Repositories\Criteria\EagerLoad;
use App\Repositories\Criteria\OrderBy;
use App\Repositories\Criteria\Select;
use App\Repositories\Criteria\WhereLike;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Categories\Repositories\Contracts\CategoriesRepository;
use Modules\Companies\Repositories\Contracts\CompaniesRepository;
use Modules\Jobs\Entities\Job;
use Modules\Jobs\Repositories\Contracts\JobsRepository;
use Modules\Roles\Repositories\Contracts\RolesRepository;

class JobsController extends Controller
{
    public function __construct(private readonly ResponseFactory $response, private readonly JobsRepository $jobsRepository, private readonly RolesRepository $rolesRepository, private readonly CompaniesRepository $companiesRepository, private readonly CategoriesRepository $categoriesRepository)
    {
    }

    public function index()
    {
        return view('jobs::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('jobs::create');
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


    public function show(User $user)
    {
        $result = $this->jobsRepository->initCategories($this->categoriesRepository->get(['id', 'name', 'type']));

        $result['states'] = $this->jobsRepository->getStates();
        $result['salaryTypes'] = $this->jobsRepository->salaryTypes();
        $result['roles'] = $this->rolesRepository->all(['id', 'name']);
        $result['companies'] = $this->companiesRepository->withCriteria([
            new ByUser($user->id)
        ])->all(['id', 'name', 'user_id']);


        return $this->response->json(['data' => $result], Response::HTTP_OK, [], JSON_NUMERIC_CHECK);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('jobs::edit');
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
