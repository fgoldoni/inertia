<?php
namespace Modules\Dashboard\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Dashboard\Repositories\Contracts\DashboardRepository;
use Modules\Dashboard\Repositories\Eloquent\EloquentDashboardRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    protected $defer = false;

    public function boot()
    {
        $this->app->bind(DashboardRepository::class, EloquentDashboardRepository::class);
    }
}
