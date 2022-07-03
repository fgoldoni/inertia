<?php
namespace Modules\Companies\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\Criteria\EagerLoad;
use App\Repositories\Criteria\OrderBy;
use App\Repositories\Criteria\Select;
use App\Repositories\Criteria\WhereKey;
use App\Repositories\Criteria\WhereLike;
use App\Repositories\Criteria\WithTrashed;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Inertia\Inertia;
use Modules\Companies\Entities\Company;
use Modules\Companies\Http\Requests\UpdateCompanyRequest;
use Modules\Companies\Http\Requests\StoreCompanyRequest;
use Modules\Companies\Repositories\Contracts\CompaniesRepository;
use Modules\Jobs\Entities\Job;

class CompaniesController extends Controller
{
    public function __construct(private readonly CompaniesRepository $companiesRepository, private readonly ResponseFactory $response, private readonly Request $request)
    {
    }

    public function index(array $modalProps = [])
    {
        Inertia::share('can', fn (Request $request) => $request->user() ? [
            'is_impersonated' => $request->user()->isImpersonated(),
            'create' => $request->user()->can('create', Company::class),
            'edit' => $this->request->user()->hasPermissionTo('edit_companies'),
            'delete' => $this->request->user()->hasPermissionTo('delete_companies'),
        ] : null);

        return Inertia::render('Modules/Companies/Index', array_merge([
            'filters' => $this->request->only(['search', 'perPage', 'page', 'field', 'direction']),
            'rowData' => $this->companiesRepository->withCriteria([
                new Select('id', 'name', 'email', 'phone', 'user_id', 'online', 'created_at', 'updated_at', 'deleted_at'),
                new WhereLike(['companies.id', 'companies.name', 'companies.email', 'companies.content'], $this->request->get('search')),
                new OrderBy($this->request->get('field', ''), $this->request->get('direction')),
                new EagerLoad(['user:id,name', 'jobs:id,company_id']),
                new WithTrashed(),
            ])->paginate()->withQueryString(),

        ], $modalProps));
    }

    public function create(Request $request)
    {
        $this->authorize('create', Company::class);

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
        $this->authorize('edit', $company);

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

        return $this->response->json(
            ['message' => __('The Company (:item) has been successfully updated', ['item' => $company->name])],
            Response::HTTP_OK,
            [],
            JSON_NUMERIC_CHECK
        );
    }

    public function destroy($selected)
    {
        $items = $this->companiesRepository->withCriteria([
            new WhereKey(explode(',', (string) $selected)),
            new WithTrashed(),
        ])->get();


        foreach ($items as $item) {
            if ($item->trashed()) {
                $item->forceDelete();
            } else {
                $item->delete();
            }
        }

        return $this->response->json(
            ['message' => __('The Companies has been successfully deleted')],
            Response::HTTP_OK,
            [],
            JSON_NUMERIC_CHECK
        );
    }

    public function restore(int $id)
    {
        $company = $this->companiesRepository->withCriteria([
            new WithTrashed(),
        ])->restore($id);

        return $this->response->json(
            ['message' => __('The Company (:item) has been successfully restored', ['item' => $company->name])],
            Response::HTTP_OK,
            [],
            JSON_NUMERIC_CHECK
        );
    }
}
