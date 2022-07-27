<?php

namespace Modules\Companies\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Modules\Companies\Entities\Company;
use Modules\Companies\Policies\CompanyPolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Company::class => CompanyPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
