<?php
namespace Modules\Jobs\Services;

use App\Repositories\Criteria\EagerLoad;
use App\Repositories\Criteria\Filters;
use App\Repositories\Criteria\OrderBy;
use App\Repositories\Criteria\WhereArea;
use App\Repositories\Criteria\WhereHas;
use App\Repositories\Criteria\WhereIn;
use App\Repositories\Criteria\WhereLike;
use App\Repositories\Criteria\WherePublished;
use App\Services\ServiceAbstract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Collection;
use Modules\Jobs\Repositories\Contracts\JobsRepository;
use Modules\Jobs\Services\Contracts\JobsServiceInterface;
use Modules\Jobs\Transformers\ApiJobResource;

/**
 * Class JobsService.
 */
class JobsService extends ServiceAbstract implements JobsServiceInterface
{
    protected function repository(): string
    {
        return JobsRepository::class;
    }

    public function apiJobs(): AnonymousResourceCollection
    {
        return ApiJobResource::collection($this->repository->withCriteria([
            new Filters(request()->get('filters')),
            new WhereLike(['jobs.id', 'jobs.name'], request()->get('search')),
            new WherePublished(),
            new EagerLoad([
                'user:id,name',
                'team:id,name,display_name',
                'company:id,name',
                'categories:id,name,type',
                'country:id,name,emoji',
                'city:id,name',
                'division:id,name'
            ]),
        ])->get());
    }

    public function apiJob(int $id): ApiJobResource
    {
        return new ApiJobResource($this->repository->withCriteria([
            new Filters(request()->get('filters')),
            new WhereLike(['jobs.id', 'jobs.name'], request()->get('search')),
            new WherePublished(),
            new EagerLoad([
                'user:id,name',
                'team:id,name,display_name',
                'company:id,name,phone,avatar_path',
                'categories:id,name,type',
                'country:id,name,emoji',
                'city:id,name',
                'division:id,name',
                'tags:id,name'
            ]),
        ])->find($id));
    }

    public function search(Request $request): Collection
    {
        return $this->repository->withCriteria([
            new EagerLoad(['categories']),
            new WhereLike(['jobs.id', 'jobs.name', 'jobs.content'], $request->get('search')),
            new WhereIn('jobs.id', $request->input('selected', [])),
            new WherePublished(),
            new OrderBy('name', 'asc'),
        ])->all()->map(function ($job) {
            return [
                'id' => $job->id,
                'name' => $job->name,
                'slug' => $job->slug,
                'category' => $job->categories()->get()->areas()->value('name'),
                'avatar_url' => $job->avatar_url,
            ];
        });
    }
}
