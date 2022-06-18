<?php

namespace Modules\Categories\Http\Controllers;

use App\Repositories\Criteria\EagerLoad;
use App\Repositories\Criteria\OrderBy;
use App\Repositories\Criteria\WhereLike;
use App\Repositories\Criteria\WithCount;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Inertia\Inertia;
use Modules\Categories\Entities\Category;
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
            ])->paginate(),

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

    public function store(Request $request)
    {
        //
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
            ])->find($category->id)
        ]);
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
