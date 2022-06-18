<?php
namespace Modules\Countries\Http\Controllers;

use App\Repositories\Criteria\EagerLoad;
use App\Repositories\Criteria\OrderBy;
use App\Repositories\Criteria\Select;
use App\Repositories\Criteria\WhereLike;
use App\Repositories\Criteria\WithCount;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Inertia\Inertia;
use Modules\Countries\Entities\Country;
use Modules\Countries\Entities\Division;
use Modules\Countries\Http\Requests\UpdateCountryRequest;
use Modules\Countries\Http\Requests\UpdateDivisionRequest;
use Modules\Countries\Repositories\Contracts\DivisionsRepository;

class DivisionsController extends Controller
{
    public function __construct(private readonly DivisionsRepository $divisionsRepository, private readonly ResponseFactory $response, private readonly Request $request)
    {
    }

    public function index(array $modalProps = [])
    {
        return Inertia::render('Modules/Divisions/Index', array_merge([
            'filters' => $this->request->only(['search', 'perPage', 'page', 'field', 'direction']),
            'rowData' => $this->divisionsRepository->withCriteria([
                new Select('id', 'name', 'full_name', 'country_id'),
                new WhereLike(['world_divisions.id', 'world_divisions.name', 'world_divisions.full_name'], $this->request->get('search')),
                new OrderBy($this->request->get('field', ''), $this->request->get('direction')),
                new EagerLoad(['country:id,name,emoji']),
                new WithCount(['cities'])
            ])->paginate()->withQueryString(),

        ], $modalProps));
    }


    public function create()
    {
        return view('countries::create');
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        return view('countries::show');
    }

    public function edit(Request $request, Division $division)
    {
        Inertia::modal('Modules/Divisions/EditModal');

        Inertia::basePageRoute(route('admin.divisions.index', $this->request->only(['search', 'perPage', 'page', 'field', 'direction'])));

        return $this->index([
            'editing' => $this->divisionsRepository->withCriteria([
                new Select('id', 'name', 'full_name', 'country_id'),
                new EagerLoad(['country:id,name,emoji']),
                new WithCount(['cities'])
            ])->find($division->id, ['id', 'name', 'full_name', 'country_id'])
        ]);
    }

    public function update(UpdateDivisionRequest $request, Division $division)
    {
        $division = $this->divisionsRepository->update($division->id, $request->only('name'));

        return $this->response
            ->json([], Response::HTTP_OK, [], JSON_NUMERIC_CHECK)
            ->flash(__(':division updated successfully!', ['division' => $division->name]));
    }


    public function destroy($id)
    {
        //
    }
}
