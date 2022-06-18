<?php
namespace Modules\Categories\Http\Controllers\Api;

use App\Repositories\Criteria\OrderBy;
use App\Repositories\Criteria\WhereLike;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Categories\Repositories\Contracts\CategoriesRepository;

class CategoriesController extends Controller
{
    public function __construct(private readonly ResponseFactory $response, private readonly CategoriesRepository $categoriesRepository)
    {
    }

    public function index(Request $request)
    {
        $categories = $this->categoriesRepository->withCriteria([
            new WhereLike(['categories.id', 'categories.name', 'categories.slug'], $request->get('search')),
            new OrderBy('name', 'asc'),
        ])->all(['id', 'name', 'online', 'created_at']);

        return $this->response->json(['data' => $categories], Response::HTTP_OK, [], JSON_NUMERIC_CHECK);
    }

    /**
     * Store a newly created resource in storage.
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
