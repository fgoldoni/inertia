<?php
namespace Modules\Jobs\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Modules\Jobs\Entities\Job;

class JobViewCountEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public Job $job)
    {
    }
}
