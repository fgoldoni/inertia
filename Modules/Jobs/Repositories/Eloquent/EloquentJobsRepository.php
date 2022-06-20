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

    public function initCategories($categories): array
    {
        return [
            'areas' => $categories->areas(),
            'industries' => array_values($categories->industries()->toArray()),
            'jobTypes' => array_values($categories->jobTypes()->toArray()),
            'salaryTypes' => array_values($categories->salaryTypes()->toArray()),
            'jobLevels' => array_values($categories->jobLevels()->toArray()),
            'genders' => array_values($categories->genders()->toArray()),
            'experiences' => array_values($categories->experiences()->toArray()),
            'careerLevels' => array_values($categories->careerLevels()->toArray()),
            'applyTypes' => array_values($categories->applyTypes()->toArray()),
        ];
    }
}
