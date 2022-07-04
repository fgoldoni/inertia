<?php

/**
 * Created by PhpStorm.
 * User: goldoni
 * Date: 24.09.18
 * Time: 21:18.
 */

namespace Modules\Users\Repositories\Eloquent;

use App\Models\Team;
use App\Repositories\RepositoryAbstract;
use Modules\Users\Repositories\Contracts\TeamsRepository;

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
