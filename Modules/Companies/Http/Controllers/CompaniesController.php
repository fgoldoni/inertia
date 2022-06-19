<?php

namespace Modules\Companies\Http\Controllers;

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
use Modules\Companies\Entities\Company;
use Modules\Companies\Http\Requests\UpdateCompanyRequest;
use Modules\Companies\Http\Requests\StoreCompanyRequest;
use Modules\Companies\Repositories\Contracts\CompaniesRepository;

class CompaniesController extends Controller
{
    public function __construct(private readonly CompaniesRepository $companiesRepository, private readonly ResponseFactory $response, private readonly Request $request)
    {
    }

    public function index(array $modalProps = [])
    {
        return Inertia::render('Modules/Companies/Index', array_merge([
            'filters' => $this->request->only(['search', 'perPage', 'page', 'field', 'direction']),
            'rowData' => $this->companiesRepository->withCriteria([
                new Select('id', 'name', 'email', 'phone', 'user_id', 'live_at', 'created_at', 'updated_at'),
                new WhereLike(['companies.id', 'companies.name', 'companies.email', 'companies.content'], $this->request->get('search')),
                new OrderBy($this->request->get('field', ''), $this->request->get('direction')),
                new EagerLoad(['user:id,name', 'jobs:id,company_id']),
            ])->paginate()->withQueryString(),

        ], $modalProps));
    }

    public function create(Request $request)
    {
        Inertia::modal('Modules/Companies/CreateModal');

        Inertia::basePageRoute(route('admin.companies.index', $this->request->only(['search', 'perPage', 'page', 'field', 'direction'])));

        return $this->index([
            'editing' => $this->companiesRepository->make([
                'id' => null,
                'name' => 'test',
                'seo_title' => 'test',
                'seo_description' => 'test',
                'seo_description' => 'test',
                'online' => true
            ])
        ]);
    }

    public function store(StoreCompanyRequest $request)
    {
        $category = $this->companiesRepository->create($request->only('name', 'online', 'seo_title', 'seo_description', 'parent_id'));

        return $this->response
            ->json([], Response::HTTP_CREATED, [], JSON_NUMERIC_CHECK)
            ->flash(__(':category successfully added!', ['company' => $company->name]));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('companies::show');
    }

    public function edit(Request $request, Company $company)
    {
        Inertia::modal('Modules/Companies/EditModal');

        Inertia::basePageRoute(route('admin.companies.index', $this->request->only(['search', 'perPage', 'page', 'field', 'direction'])));

        return $this->index([
            'editing' => $this->companiesRepository->withCriteria([
                new EagerLoad(['jobs:id,company_id']),
            ])->find($company->id, ['id', 'name', 'email', 'phone', 'user_id', 'live_at', 'created_at', 'updated_at'])
        ]);
    }

    public function update(UpdateCompanyRequest $request, Company $company)
    {
        $category = $this->companiesRepository->update($category->id, $request->only('name', 'online', 'seo_title', 'seo_description', 'parent_id'));

        return $this->response
            ->json([], Response::HTTP_OK, [], JSON_NUMERIC_CHECK)
            ->flash(__(':category updated successfully!', ['category' => $category->name]));
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
