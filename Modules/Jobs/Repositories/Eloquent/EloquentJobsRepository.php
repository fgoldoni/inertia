<?php

/**
 * Created by PhpStorm.
 * User: goldoni
 * Date: 24.09.18
 * Time: 21:18.
 */

namespace Modules\Jobs\Repositories\Eloquent;

use App\Repositories\RepositoryAbstract;
use Illuminate\Support\Collection;
use Modules\Jobs\Entities\Category;
use Modules\Jobs\Entities\Job;
use Modules\Jobs\Entities\Role;
use Modules\Jobs\Enums\JobState;
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

    public function getStates(): Collection
    {
        return collect([
            [
                'id' => (JobState::Draft)->value,
                'name' => ucfirst((JobState::Draft)->value),
            ],
            [
                'id' => (JobState::Published)->value,
                'name' => ucfirst((JobState::Published)->value),
            ],
            [
                'id' => (JobState::Archived)->value,
                'name' => ucfirst((JobState::Archived)->value),
            ],
            [
                'id' => (JobState::Hold)->value,
                'name' => ucfirst((JobState::Hold)->value),
            ]
        ]);
    }
}
