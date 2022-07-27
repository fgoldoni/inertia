<?php

namespace Modules\Countries\Http\Controllers\Api;

use App\Repositories\Criteria\EagerLoad;
use App\Repositories\Criteria\Limit;
use App\Repositories\Criteria\OrderBy;
use App\Repositories\Criteria\Where;
use App\Repositories\Criteria\WhereLike;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Countries\Repositories\Contracts\CitiesRepository;

class CitiesController extends Controller
{
    public function __construct(private readonly ResponseFactory $response, private readonly CitiesRepository $citiesRepository)
    {
    }

    public function index(Request $request)
    {
        $cities = [];

        if (strlen((string) $request->get('search')) > 2) {
            $cities = $this->citiesRepository->withCriteria([
                new WhereLike(['world_cities.id', 'world_cities.name', 'world_cities.full_name'], $request->get('search')),
                new Where('country_id', $request->get('country_id')),
                new OrderBy('name', 'asc'),
                new EagerLoad(['country:id,name,emoji', 'division:id,name']),
                new Limit(10),
            ])->all(['id', 'name', 'country_id', 'division_id']);
        }

        return $this->response->json(['data' => $cities], Response::HTTP_OK, [], JSON_NUMERIC_CHECK);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Renderable
     */
    public function create()
    {
        return view('countries::create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     *
     * @param  int  $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('countries::show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('countries::edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
