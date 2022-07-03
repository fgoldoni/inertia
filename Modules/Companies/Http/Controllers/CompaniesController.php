<?php
namespace Modules\Companies\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\Criteria\EagerLoad;
use App\Repositories\Criteria\OrderBy;
use App\Repositories\Criteria\Select;
use App\Repositories\Criteria\WhereKey;
use App\Repositories\Criteria\WhereLike;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
                new Select('id', 'name', 'email', 'phone', 'user_id', 'online', 'created_at', 'updated_at'),
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
                'name' => 'test' . uniqid(),
                'content' => 'test',
                'email' => 'test' . uniqid() . '@test.com',
                'phone' => '+4915736795436',
                'online' => true
            ])
        ]);
    }

    public function store(StoreCompanyRequest $request)
    {
        $company = $this->companiesRepository->create(array_merge(
            $request->only('name', 'content', 'email', 'phone', 'online'),
            [
                'user_id' => auth()->user()->id
            ]
        ));

        return $this->response
            ->json([], Response::HTTP_CREATED, [], JSON_NUMERIC_CHECK)
            ->flash(__(':company successfully added!', ['company' => $company->name]));
    }

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
            ])->find($company->id, ['id', 'name', 'content', 'email', 'phone', 'user_id', 'online', 'created_at', 'updated_at'])
        ]);
    }

    public function update(UpdateCompanyRequest $request, Company $company)
    {
        $company = $this->companiesRepository->update($company->id, $request->only('name', 'content', 'email', 'phone', 'online'));

        return $this->response
            ->json([], Response::HTTP_OK, [], JSON_NUMERIC_CHECK)
            ->flash(__(':company updated successfully!', ['company' => $company->name]));
    }

    public function destroy($selected)
    {
        $this->companiesRepository->withCriteria([
            new WhereKey(explode(',', (string) $selected))
        ])->deleteAll();

        return $this->response->json(['message' => __('Company deleted successfully.')], Response::HTTP_NO_CONTENT, [], JSON_NUMERIC_CHECK);
    }
}
