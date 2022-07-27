<?php

namespace Modules\Jobs\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Jobs\Repositories\Contracts\JobsRepository;
use Modules\Jobs\Repositories\Eloquent\EloquentJobsRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    protected $defer = false;

    public function boot()
    {
        $this->app->bind(JobsRepository::class, EloquentJobsRepository::class);
    }
}
