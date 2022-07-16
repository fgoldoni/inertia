<?php

namespace Modules\Jobs\Services;

use App\Repositories\Criteria\EagerLoad;
use App\Repositories\Criteria\OrderBy;
use App\Repositories\Criteria\Select;
use App\Repositories\Criteria\WhereLike;
use App\Repositories\Criteria\WithTrashed;
use App\Services\ServiceAbstract;
use Modules\Jobs\Repositories\Contracts\JobsRepository;
use Modules\Jobs\Services\Contracts\JobsServiceInterface;

/**
 * Class JobsService.
 */
class JobsService extends ServiceAbstract implements JobsServiceInterface
{
    protected function repository(): string
    {
        return JobsRepository::class;
    }

    public function get()
    {
        $this->repository->withCriteria([
            new WhereLike(['jobs.id', 'jobs.name'], request()->get('search')),
            new OrderBy(request()->get('field', ''), request()->get('direction')),
            new EagerLoad([
                'user:id,name',
                'company:id,name',
                'categories:id,name,type',
                'country:id,name,emoji',
                'city:id,name',
                'division:id,name'
            ]),
        ])->paginate();
    }
}
