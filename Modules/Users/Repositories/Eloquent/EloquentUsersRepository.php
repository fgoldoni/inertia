<?php

/**
 * Created by PhpStorm.
 * User: goldoni
 * Date: 24.09.18
 * Time: 21:18.
 */

namespace Modules\Users\Repositories\Eloquent;

use App\Models\Team;
use App\Models\User;
use App\Repositories\RepositoryAbstract;
use Modules\Users\Repositories\Contracts\UsersRepository;

/**
 * Class EloquentPostsRepository.
 */
class EloquentUsersRepository extends RepositoryAbstract implements UsersRepository
{
    public function model()
    {
        return User::class;
    }


    public function createTeam(User $user)
    {
        $user->ownedTeams()->save(Team::forceCreate([
            'user_id' => $user->id,
            'name' => explode(' ', (string) $user->name, 2)[0] . "'s Team",
            'personal_team' => true,
        ]));
    }
}
