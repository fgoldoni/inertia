<?php
namespace Modules\Jobs\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Modules\Jobs\Entities\Job;
use Modules\Jobs\Policies\JobPolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Job::class => JobPolicy::class
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
