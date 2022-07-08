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
use App\Repositories\Criteria\Where;
use App\Repositories\RepositoryAbstract;
use Illuminate\Support\Facades\Notification;
use Jenssegers\Agent\Agent;
use Laravel\Jetstream\Jetstream;
use Laravel\Sanctum\NewAccessToken;
use Modules\Users\Notifications\LoginLinkNotification;
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

    public function createAgent($session)
    {
        return tap(new Agent, function ($agent) use ($session) {
            $agent->setUserAgent($session->user_agent);
        });
    }

    public function isExist(string $email): bool
    {
        return $this->withCriteria([
            new Where('email', $email)
        ])->exists();
    }

    public function sendLoginLink(User $user, NewAccessToken $token, string $host)
    {
        Notification::send($user, new LoginLinkNotification($user, $token, $host));
    }

    public function createToken(User $user): NewAccessToken
    {
        return $user->createToken(
            $user->name,
            Jetstream::$defaultPermissions
        );
    }
}
