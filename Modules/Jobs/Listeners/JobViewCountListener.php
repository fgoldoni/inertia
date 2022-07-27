<?php

namespace Modules\Jobs\Listeners;

use Modules\Jobs\Events\JobViewCountEvent;

class JobViewCountListener
{
    public function handle(JobViewCountEvent $event)
    {
        $event->job->increment('view_count');
    }
}
