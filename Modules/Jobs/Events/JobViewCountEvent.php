<?php

namespace Modules\Jobs\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Modules\Jobs\Entities\Job;

class JobViewCountEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Job $job;

    public function __construct(Job $job)
    {
        $this->job = $job;
    }
}
