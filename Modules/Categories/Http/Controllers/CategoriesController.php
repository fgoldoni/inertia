<?php

namespace Modules\Categories\Http\Controllers;

use App\Repositories\Criteria\EagerLoad;
use App\Repositories\Criteria\OrderBy;
use App\Repositories\Criteria\WhereHas;
use App\Repositories\Criteria\WhereKey;
use App\Repositories\Criteria\WhereLike;
use App\Repositories\Criteria\WhereNot;
use App\Repositories\Criteria\WithCount;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Inertia\Inertia;
use Modules\Categories\Entities\Category;
use Modules\Categories\Http\Requests\StoreCategoryRequest;
use Modules\Categories\Http\Requests\UpdateCategoryRequest;
use Modules\Categories\Repositories\Contracts\CategoriesRepository;
use Modules\Roles\Entities\Role;
use Modules\Roles\Transformers\RoleResource;

class CategoriesController extends Controller
{
    public function __construct(private readonly CategoriesRepository $categoriesRepository, private readonly ResponseFactory $response, private readonly Request $request) {}


    public function index(array $modalProps = [])
    {
        return Inertia::render('Modules/Categories/Index', array_merge([
            'filters' => $this->request->only(['search', 'perPage', 'page', 'field', 'direction']),
            'rowData' => $this->categoriesRepository->withCriteria([
                new WhereLike(['categories.id', 'categories.name', 'categories.slug'], $this->request->get('search')),
                new OrderBy($this->request->get('field', ''), $this->request->get('direction')),
                new EagerLoad(['parent:id,name']),
            ])->paginate()->withQueryString(),

        ], $modalProps));
    }


    public function create(Request $request)
    {
        Inertia::modal('Modules/Categories/CreateModal');

        Inertia::basePageRoute(route('admin.categories.index'));

        return $this->index([
            'editing' => $this->categoriesRepository->make([
                'id' => null,
                'name' => 'test',
                'seo_title' => 'test',
                'seo_description' => 'test',
                'seo_description' => 'test',
                'online' => true
            ])
        ]);
    }

    public function store(StoreCategoryRequest $request)
    {
        $category = $this->categoriesRepository->create($request->only('name', 'online', 'seo_title', 'seo_description', 'parent_id'));

        return $this->response
            ->json([], Response::HTTP_CREATED, [], JSON_NUMERIC_CHECK)
            ->flash(__(':category successfully added!', ['category' => $category->name]));
    }

    public function show($id)
    {
        return view('categories::show');
    }


    public function edit(Request $request, Category $category)
    {
        Inertia::modal('Modules/Categories/EditModal');

        Inertia::basePageRoute(route('admin.categories.index'));

        return $this->index([
            'editing' => $this->categoriesRepository->withCriteria([
                new EagerLoad(['parent:id,name']),
            ])->find($category->id, ['id', 'name', 'online', 'seo_title', 'seo_description', 'parent_id'])
        ]);
    }


    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category = $this->categoriesRepository->update($category->id, $request->only('name', 'online', 'seo_title', 'seo_description', 'parent_id'));

        return $this->response
            ->json([], Response::HTTP_OK, [], JSON_NUMERIC_CHECK)
            ->flash(__(':category updated successfully!', ['category' => $category->name]));
    }


    public function destroy($selected)
    {
        $this->categoriesRepository->withCriteria([
            new WhereKey(explode(',', (string) $selected))
        ])->deleteAll();

        return $this->response->json(['message' => __('Category deleted successfully.')], Response::HTTP_NO_CONTENT, [], JSON_NUMERIC_CHECK);
    }
}
