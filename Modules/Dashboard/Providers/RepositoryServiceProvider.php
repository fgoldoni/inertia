<?php
namespace Modules\Dashboard\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Dashboard\Repositories\Contracts\DashboardRepository;
use Modules\Dashboard\Repositories\Contracts\DashboardUserRepository;
use Modules\Dashboard\Repositories\Eloquent\EloquentDashboardRepository;
use Modules\Dashboard\Repositories\Eloquent\EloquentDashboardUserRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    protected $defer = false;

    public function boot()
    {
        $this->app->bind(DashboardRepository::class, EloquentDashboardRepository::class);
        $this->app->bind(DashboardUserRepository::class, EloquentDashboardUserRepository::class);
    }
}
