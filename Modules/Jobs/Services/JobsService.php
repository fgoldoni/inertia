<?php

namespace Modules\Jobs\Services;

use App\Repositories\Criteria\EagerLoad;
use App\Repositories\Criteria\Where;
use App\Repositories\Criteria\WhereLike;
use App\Services\ServiceAbstract;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Modules\Jobs\Enums\JobState;
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
            new WhereLike(['jobs.id', 'jobs.name'], request()->get('search')),
            new Where('state', (JobState::Published)->value),
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
}
