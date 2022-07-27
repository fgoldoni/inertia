<?php

namespace Modules\Teams\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\Teams\Listeners\TeamsSubscriber;

class EventServiceProvider extends ServiceProvider
{
    public function boot()
    {
        parent::boot();
    }

    protected $subscribe = [
        TeamsSubscriber::class,
    ];
}
