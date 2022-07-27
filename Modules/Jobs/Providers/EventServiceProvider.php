<?php

namespace Modules\Jobs\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\Jobs\Events\JobViewCountEvent;
use Modules\Jobs\Listeners\JobsSubscriber;
use Modules\Jobs\Listeners\JobViewCountListener;

class EventServiceProvider extends ServiceProvider
{
    public function boot()
    {
        parent::boot();
    }

    protected $subscribe = [
        JobsSubscriber::class,
    ];

    protected $listen = [
        JobViewCountEvent::class => [
            JobViewCountListener::class,
        ],
    ];
}
