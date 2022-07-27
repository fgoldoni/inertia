<?php

namespace Modules\Companies\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\Companies\Listeners\CompaniesSubscriber;

class EventServiceProvider extends ServiceProvider
{
    public function boot()
    {
        parent::boot();
    }

    protected $subscribe = [
        CompaniesSubscriber::class,
    ];
}
