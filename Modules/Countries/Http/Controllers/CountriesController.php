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
use Modules\Categories\Entities\Category;
use Modules\Countries\Entities\Country;
use Modules\Countries\Http\Requests\UpdateCountryRequest;
use Modules\Countries\Repositories\Contracts\CountriesRepository;

class CountriesController extends Controller
{
    public function __construct(private readonly CountriesRepository $countriesRepository, private readonly ResponseFactory $response, private readonly Request $request) {}


    public function index(array $modalProps = [])
    {
        return Inertia::render('Modules/Countries/Index', array_merge([
            'filters' => $this->request->only(['search', 'perPage', 'page', 'field', 'direction']),
            'rowData' => $this->countriesRepository->withCriteria([
                new Select('id', 'name', 'full_name', 'continent_id', 'emoji', 'currency_code', 'currency_name', 'capital'),
                new WhereLike(['world_countries.id', 'world_countries.name', 'world_countries.full_name', 'world_countries.capital', 'world_countries.currency_code', 'world_countries.currency_name'], $this->request->get('search')),
                new OrderBy($this->request->get('field', ''), $this->request->get('direction')),
                new EagerLoad(['continent:id,name', 'locales:id,name,country_id']),
            ])->paginate()->withQueryString(),

        ], $modalProps));
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


    public function edit(Request $request, Country $country)
    {
        Inertia::modal('Modules/Countries/EditModal');

        Inertia::basePageRoute(route('admin.countries.index'));

        return $this->index([
            'editing' => $this->countriesRepository->find($country->id, ['id', 'name', 'full_name', 'continent_id', 'emoji', 'currency_code', 'currency_name', 'capital'])
        ]);
    }


    public function update(UpdateCountryRequest $request, Country $country)
    {
        $country = $this->countriesRepository->update($country->id, $request->only('name'));

        return $this->response
            ->json([], Response::HTTP_OK, [], JSON_NUMERIC_CHECK)
            ->flash(__(':country updated successfully!', ['country' => $country->name]));
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
