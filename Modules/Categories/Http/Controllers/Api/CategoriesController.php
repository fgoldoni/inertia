<?php

namespace Modules\Categories\Http\Controllers\Api;

use App\Repositories\Criteria\OrderBy;
use App\Repositories\Criteria\Where;
use App\Repositories\Criteria\WhereArea;
use App\Repositories\Criteria\WhereHas;
use App\Repositories\Criteria\WhereIn;
use App\Repositories\Criteria\WhereLike;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Categories\Enums\CategoryType;
use Modules\Categories\Repositories\Contracts\CategoriesRepository;

class CategoriesController extends Controller
{
    public function __construct(
        private readonly ResponseFactory $response,
        private readonly CategoriesRepository $categoriesRepository
    ) {
    }

    public function index(Request $request)
    {
        $categories = $this->categoriesRepository->withCriteria([
            new WhereLike(['categories.id', 'categories.name', 'categories.slug'], $request->get('search')),
            new OrderBy('name', 'asc'),
        ])->all(['id', 'name', 'online', 'avatar_path', 'created_at']);

        return $this->response->json(['data' => $categories], Response::HTTP_OK, [], JSON_NUMERIC_CHECK);
    }

    public function search(Request $request)
    {
        $categories = $this->categoriesRepository->withCriteria([
            new WhereLike(['categories.id', 'categories.name', 'categories.slug'], $request->get('search')),
            new WhereIn('categories.id', $request->input('selected', [])),
            new WhereArea(),
            new OrderBy('name', 'asc'),
            new WhereHas('jobs', function (Builder $query) {
                $query->where(
                    'jobs.team_id',
                    session(
                        config('app.system.sessions.keys.team'),
                        auth()->user()?->currentTeam?->id
                    )
                )->published();
            }),
        ])->all(['id', 'name', 'online', 'avatar_path', 'created_at'])->map(function ($category)  {
            return [
                'id' => $category->id,
                'name' => $category->name,
                'avatar_url' => $category->avatar_url,
            ];
        });

        return $this->response->json(['data' => $categories], Response::HTTP_OK, [], JSON_NUMERIC_CHECK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
