<?php

namespace Modules\Users\Repositories\Contracts;

use App\Models\User;
use Laravel\Sanctum\NewAccessToken;

interface UsersRepository
{
    public function createTeam(User $user);

    public function createAgent($session);

    public function isExist(string $email): bool;

    public function sendLoginLink(User $user, NewAccessToken $token, string $host);

    public function createToken(User $user): NewAccessToken;
}
