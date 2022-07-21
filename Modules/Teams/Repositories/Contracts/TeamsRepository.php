<?php
namespace Modules\Teams\Repositories\Contracts;

use App\Models\Team;
use App\Models\User;

interface TeamsRepository
{
    public function teamFromHost(string $host): ?Team;

    public function attachUser(?Team $team, User $user);
}
