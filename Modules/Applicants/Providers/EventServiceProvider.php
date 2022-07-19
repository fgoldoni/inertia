<?php
namespace Modules\Applicants\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\Applicants\Listeners\ApplicantsSubscriber;

class EventServiceProvider extends ServiceProvider
{
    public function boot()
    {
        parent::boot();
    }

    protected $subscribe = [
        ApplicantsSubscriber::class
    ];
}
