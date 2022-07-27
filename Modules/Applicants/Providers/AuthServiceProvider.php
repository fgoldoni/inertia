<?php

namespace Modules\Applicants\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Modules\Applicants\Entities\Applicant;
use Modules\Applicants\Policies\ApplicantPolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Applicant::class => ApplicantPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
