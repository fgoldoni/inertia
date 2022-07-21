<?php

/**
 * Created by PhpStorm.
 * User: goldoni
 * Date: 24.09.18
 * Time: 21:18.
 */
namespace Modules\Roles\Repositories\Eloquent;

use App\Repositories\RepositoryAbstract;
use Modules\Roles\Entities\Permission;
use Modules\Roles\Repositories\Contracts\PermissionsRepository;

/**
 * Class EloquentPostsRepository.
 */
class EloquentPermissionsRepository extends RepositoryAbstract implements PermissionsRepository
{
    public function model(): string
    {
        return Permission::class;
    }
}
