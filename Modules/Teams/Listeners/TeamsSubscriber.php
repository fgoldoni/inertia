<?php
namespace Modules\Teams\Listeners;

use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use Modules\Teams\Notifications\TeamCreatedNotification;
use Modules\Teams\Notifications\TeamDeletedNotification;
use Modules\Teams\Notifications\TeamRestoredNotification;

class TeamsSubscriber
{
    public function __construct(private readonly Team $job)
    {
    }

    public function subscribe($events)
    {
        $events->listen('eloquent.created: ' . Team::class, $this->handleTeamCreated(...));
        $events->listen('eloquent.deleting: ' . Team::class, $this->handleTeamDeleted(...));
        $events->listen('eloquent.restored: ' . Team::class, $this->handleTeamRestored(...));
    }

    public function handleTeamCreated(Team $job)
    {
        $admin = $this->fetchByRole(config('app.system.users.roles.administrator'));

        Notification::send($admin, new TeamCreatedNotification($job));
    }

    public function handleTeamDeleted(Team $job)
    {
        $admin = $this->fetchByRole(config('app.system.users.roles.administrator'));

        Notification::send($admin, new TeamDeletedNotification($job));
    }

    public function handleTeamRestored(Team $job)
    {
        $admin = $this->fetchByRole(config('app.system.users.roles.administrator'));

        Notification::send($admin, new TeamRestoredNotification($job));
    }

    public function fetchByRole(string $role)
    {
        return User::role($role)->get();
    }
}
