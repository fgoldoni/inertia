<?php
namespace Modules\Roles\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Roles\Repositories\Contracts\PermissionsRepository;
use Modules\Roles\Repositories\Contracts\RolesRepository;
use Modules\Roles\Repositories\Eloquent\EloquentPermissionsRepository;
use Modules\Roles\Repositories\Eloquent\EloquentRolesRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    public function boot()
    {
        $this->app->bind(RolesRepository::class, EloquentRolesRepository::class);
        $this->app->bind(PermissionsRepository::class, EloquentPermissionsRepository::class);
    }
}
