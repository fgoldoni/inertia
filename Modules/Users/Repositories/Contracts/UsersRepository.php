<?php

namespace Modules\Users\Repositories\Contracts;

use App\Models\User;

interface UsersRepository
{
    public function createTeam(User $user);

    public function createAgent($session);
}
