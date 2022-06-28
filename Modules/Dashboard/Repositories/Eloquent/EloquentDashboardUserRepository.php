<?php

/**
 * Created by PhpStorm.
 * User: goldoni
 * Date: 24.09.18
 * Time: 21:18.
 */

namespace Modules\Dashboard\Repositories\Eloquent;

use App\Repositories\RepositoryAbstract;
use Illuminate\Support\Collection;
use Modules\Dashboard\Entities\Category;
use Modules\Dashboard\Entities\Dashboard;
use Modules\Dashboard\Entities\DashboardUser;
use Modules\Dashboard\Entities\Job;
use Modules\Dashboard\Entities\Role;
use Modules\Dashboard\Enums\JobState;
use Modules\Dashboard\Enums\SalaryType;
use Modules\Dashboard\Repositories\Contracts\DashboardUserRepository;

/**
 * Class EloquentPostsRepository.
 */
class EloquentDashboardUserRepository extends RepositoryAbstract implements DashboardUserRepository
{
    public function model(): string
    {
        return DashboardUser::class;
    }
}
