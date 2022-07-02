<?php

namespace Modules\Jobs\Listeners;

use Modules\Jobs\Entities\Job;
use Illuminate\Support\Facades\Notification;
use Modules\Jobs\Notifications\JobCreatedNotification;
use Modules\Jobs\Notifications\JobDeletedNotification;
use Modules\Jobs\Notifications\JobRestoredNotification;

class JobsSubscriber
{
    public function __construct(private readonly Job $job)
    {
    }

    public function subscribe($events)
    {
        $events->listen('eloquent.created: ' . Job::class, $this->handleJobCreated(...));
        $events->listen('eloquent.deleting: ' . Job::class, $this->handleJobDeleted(...));
        $events->listen('eloquent.restored: ' . Job::class, $this->handleJobRestored(...));
    }

    public function handleJobCreated(Job $job)
    {
        $admin = $this->fetchByRole(config('app.system.users.roles.administrator'));

        Notification::send($admin, new JobCreatedNotification($job));
    }

    public function handleJobDeleted(Job $job)
    {
        $admin = $this->fetchByRole(config('app.system.users.roles.administrator'));

        Notification::send($admin, new JobDeletedNotification($job));
    }

    public function handleJobRestored(Job $job)
    {
        $admin = $this->fetchByRole(config('app.system.users.roles.administrator'));

        Notification::send($admin, new JobRestoredNotification($job));
    }

    public function fetchByRole(string $role)
    {
        return Job::role($role)->get();
    }
}
