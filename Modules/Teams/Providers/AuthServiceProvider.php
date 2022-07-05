<?php
namespace Modules\Teams\Providers;

use App\Models\Team;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Modules\Teams\Policies\TeamPolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Team::class => TeamPolicy::class
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
