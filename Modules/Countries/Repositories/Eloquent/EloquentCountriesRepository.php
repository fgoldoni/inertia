<?php

/**
 * Created by PhpStorm.
 * User: goldoni
 * Date: 24.09.18
 * Time: 21:18.
 */

namespace Modules\Countries\Repositories\Eloquent;

use App\Repositories\RepositoryAbstract;
use Modules\Countries\Entities\Country;
use Modules\Countries\Repositories\Contracts\CountriesRepository;

/**
 * Class EloquentPostsRepository.
 */
class EloquentCountriesRepository extends RepositoryAbstract implements CountriesRepository
{
    public function model(): string
    {
        return Country::class;
    }
}
