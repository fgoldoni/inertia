<?php
namespace Modules\Teams\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Teams\Repositories\Contracts\TeamsRepository;
use Modules\Teams\Repositories\Eloquent\EloquentTeamsRepository;

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
        $this->app->bind(TeamsRepository::class, EloquentTeamsRepository::class);
    }
}
