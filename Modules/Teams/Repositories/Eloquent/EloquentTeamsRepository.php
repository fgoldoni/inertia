<?php

/**
 * Created by PhpStorm.
 * User: goldoni
 * Date: 24.09.18
 * Time: 21:18.
 */

namespace Modules\Teams\Repositories\Eloquent;

use App\Models\Team;
use App\Models\User;
use App\Repositories\Criteria\Where;
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

    public function teamFromHost(string $host): ?Team
    {
        if ($subDomain = self::getSubDomain($host)) {
            return $this->withCriteria([
                new Where('subdomain', $subDomain)
            ])->first();
        }

        return null;
    }

    private static function getSubDomain(string $host): ?string
    {
        preg_match('/(?:http[s]*\:\/\/)*(.*?)\.(?=[^\/]*\..{2,5})/i', $host, $match);

        return $match[1] ?? null;
    }

    public function attachUser(?Team $team, User $user)
    {
        if (!$user->belongsToTeam($team)) {
            $team->users()->attach(
                $user,
                ['role' => 'user']
            );
        }
    }
}
