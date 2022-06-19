<?php

/**
 * Created by PhpStorm.
 * User: goldoni
 * Date: 24.09.18
 * Time: 21:18.
 */

namespace Modules\Companies\Repositories\Eloquent;

use App\Repositories\RepositoryAbstract;
use Modules\Companies\Entities\Category;
use Modules\Companies\Entities\Company;
use Modules\Companies\Entities\Role;
use Modules\Companies\Repositories\Contracts\CompaniesRepository;

/**
 * Class EloquentPostsRepository.
 */
class EloquentCompaniesRepository extends RepositoryAbstract implements CompaniesRepository
{
    public function model(): string
    {
        return Company::class;
    }
}
