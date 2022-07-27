<?php

namespace Modules\Countries\Http\Controllers;

use App\Repositories\Criteria\EagerLoad;
use App\Repositories\Criteria\OrderBy;
use App\Repositories\Criteria\Select;
use App\Repositories\Criteria\WhereLike;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Inertia\Inertia;
use Modules\Countries\Entities\City;
use Modules\Countries\Http\Requests\UpdateCityRequest;
use Modules\Countries\Repositories\Contracts\CitiesRepository;

class CitiesController extends Controller
{
    public function __construct(private readonly CitiesRepository $citiesRepository, private readonly ResponseFactory $response, private readonly Request $request)
    {
    }

    public function index(array $modalProps = [])
    {
        return Inertia::render('Modules/Cities/Index', array_merge([
            'filters' => $this->request->only(['search', 'perPage', 'page', 'field', 'direction']),
            'rowData' => $this->citiesRepository->withCriteria([
                new Select('id', 'name', 'full_name', 'country_id', 'division_id'),
                new WhereLike(['world_cities.id', 'world_cities.name', 'world_cities.full_name'], $this->request->get('search')),
                new OrderBy($this->request->get('field', ''), $this->request->get('direction')),
                new EagerLoad(['country:id,name,emoji', 'division:id,name']),
            ])->paginate()->withQueryString(),

        ], $modalProps));
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

    public function edit(Request $request, City $city)
    {
        Inertia::modal('Modules/Cities/EditModal');

        Inertia::basePageRoute(route('admin.cities.index', $this->request->only(['search', 'perPage', 'page', 'field', 'direction'])));

        return $this->index([
            'editing' => $this->citiesRepository->withCriteria([
                new Select('id', 'name', 'full_name', 'country_id', 'division_id'),
                new EagerLoad(['country:id,name,emoji', 'division:id,name']),
            ])->find($city->id, ['id', 'name', 'full_name', 'country_id']),
        ]);
    }

    public function update(UpdateCityRequest $request, City $city)
    {
        $city = $this->divisionsRepository->update($city->id, $request->only('name'));

        return $this->response
            ->json([], Response::HTTP_OK, [], JSON_NUMERIC_CHECK)
            ->flash(__(':city updated successfully!', ['city' => $city->name]));
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
