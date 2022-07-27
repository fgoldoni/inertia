<?php

namespace Modules\Users\Listeners;

use App\Models\User;
use Illuminate\Support\Facades\Notification;
use Modules\Users\Notifications\UserCreatedNotification;
use Modules\Users\Notifications\UserDeletedNotification;
use Modules\Users\Notifications\UserRestoredNotification;

class UsersSubscriber
{
    public function __construct(private readonly User $user)
    {
    }

    public function subscribe($events)
    {
        $events->listen('eloquent.created: '.User::class, $this->handleUserCreated(...));
        $events->listen('eloquent.deleting: '.User::class, $this->handleUserDeleted(...));
        $events->listen('eloquent.restored: '.User::class, $this->handleUserRestored(...));
    }

    public function handleUserCreated(User $user)
    {
        $admin = $this->fetchByRole(config('app.system.users.roles.administrator'));

        Notification::send($admin, new UserCreatedNotification($user));
    }

    public function handleUserDeleted(User $user)
    {
        $admin = $this->fetchByRole(config('app.system.users.roles.administrator'));

        Notification::send($admin, new UserDeletedNotification($user));
    }

    public function handleUserRestored(User $user)
    {
        $admin = $this->fetchByRole(config('app.system.users.roles.administrator'));

        Notification::send($admin, new UserRestoredNotification($user));
    }

    public function fetchByRole(string $role)
    {
        return User::role($role)->get();
    }
}
