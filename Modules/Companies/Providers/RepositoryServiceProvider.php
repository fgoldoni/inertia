<?php

namespace Modules\Companies\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Companies\Repositories\Contracts\CompaniesRepository;
use Modules\Companies\Repositories\Eloquent\EloquentCompaniesRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    protected $defer = false;

    public function boot()
    {
        $this->app->bind(CompaniesRepository::class, EloquentCompaniesRepository::class);
    }
}
