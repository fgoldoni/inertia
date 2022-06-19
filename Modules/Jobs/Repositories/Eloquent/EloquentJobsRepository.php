<?php

/**
 * Created by PhpStorm.
 * User: goldoni
 * Date: 24.09.18
 * Time: 21:18.
 */

namespace Modules\Jobs\Repositories\Eloquent;

use App\Repositories\RepositoryAbstract;
use Modules\Jobs\Entities\Category;
use Modules\Jobs\Entities\Job;
use Modules\Jobs\Entities\Role;
use Modules\Jobs\Repositories\Contracts\JobsRepository;

/**
 * Class EloquentPostsRepository.
 */
class EloquentJobsRepository extends RepositoryAbstract implements JobsRepository
{
    public function model(): string
    {
        return Job::class;
    }
}
