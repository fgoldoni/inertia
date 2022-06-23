<?php

namespace Modules\Countries\Http\Controllers\Api;

use App\Repositories\Criteria\OrderBy;
use App\Repositories\Criteria\WhereLike;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Categories\Repositories\Contracts\CategoriesRepository;
use Modules\Countries\Repositories\Contracts\CitiesRepository;
use Modules\Countries\Repositories\Contracts\CountriesRepository;
use Modules\Countries\Repositories\Contracts\DivisionsRepository;

class CountriesController extends Controller
{
    public function __construct(private readonly ResponseFactory $response, private readonly CountriesRepository $countriesRepository)
    {
    }

    public function index(Request $request)
    {
        $countries = $this->countriesRepository->withCriteria([
            new WhereLike(['world_countries.id', 'world_countries.name', 'world_countries.full_name'], $request->get('search')),
            new OrderBy('name', 'asc'),
        ])->all(['id', 'name', 'emoji']);

        return $this->response->json(['data' => $countries], Response::HTTP_OK, [], JSON_NUMERIC_CHECK);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('countries::create');
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
        return view('countries::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('countries::edit');
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
