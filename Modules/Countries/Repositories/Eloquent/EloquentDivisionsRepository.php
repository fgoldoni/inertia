<?php

/**
 * Created by PhpStorm.
 * User: goldoni
 * Date: 24.09.18
 * Time: 21:18.
 */
namespace Modules\Countries\Repositories\Eloquent;

use App\Repositories\RepositoryAbstract;
use Modules\Countries\Entities\Division;
use Modules\Countries\Repositories\Contracts\DivisionsRepository;

/**
 * Class EloquentPostsRepository.
 */
class EloquentDivisionsRepository extends RepositoryAbstract implements DivisionsRepository
{
    public function model(): string
    {
        return Division::class;
    }
}
