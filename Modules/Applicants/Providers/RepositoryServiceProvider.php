<?php

namespace Modules\Applicants\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Applicants\Repositories\Contracts\ApplicantsRepository;
use Modules\Applicants\Repositories\Eloquent\EloquentApplicantsRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    protected $defer = false;

    public function boot()
    {
        $this->app->bind(ApplicantsRepository::class, EloquentApplicantsRepository::class);
    }
}
