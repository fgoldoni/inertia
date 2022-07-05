<?php

/**
 * Created by PhpStorm.
 * User: goldoni
 * Date: 24.09.18
 * Time: 21:18.
 */

namespace Modules\Teams\Repositories\Eloquent;

use App\Models\Team;
use App\Repositories\RepositoryAbstract;
use Modules\Teams\Repositories\Contracts\TeamsRepository;

/**
 * Class EloquentPostsRepository.
 */
class EloquentTeamsRepository extends RepositoryAbstract implements TeamsRepository
{
    public function model()
    {
        return Team::class;
    }
}
