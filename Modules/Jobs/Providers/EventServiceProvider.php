<?php
namespace Modules\Jobs\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\Jobs\Listeners\JobsSubscriber;

class EventServiceProvider extends ServiceProvider
{
    public function boot()
    {
        parent::boot();
    }

    protected $subscribe = [
        JobsSubscriber::class
    ];
}
