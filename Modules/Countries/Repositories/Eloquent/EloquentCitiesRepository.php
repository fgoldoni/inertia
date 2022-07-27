<?php

/**
 * Created by PhpStorm.
 * User: goldoni
 * Date: 24.09.18
 * Time: 21:18.
 */

namespace Modules\Countries\Repositories\Eloquent;

use App\Repositories\RepositoryAbstract;
use Modules\Countries\Entities\City;
use Modules\Countries\Repositories\Contracts\CitiesRepository;

/**
 * Class EloquentPostsRepository.
 */
class EloquentCitiesRepository extends RepositoryAbstract implements CitiesRepository
{
    public function model(): string
    {
        return City::class;
    }
}
