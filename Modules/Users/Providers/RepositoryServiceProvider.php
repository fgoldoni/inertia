<?php
namespace Modules\Users\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Users\Repositories\Contracts\TeamsRepository;
use Modules\Users\Repositories\Contracts\UsersRepository;
use Modules\Users\Repositories\Eloquent\EloquentTeamsRepository;
use Modules\Users\Repositories\Eloquent\EloquentUsersRepository;

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
        $this->app->bind(UsersRepository::class, EloquentUsersRepository::class);
        $this->app->bind(TeamsRepository::class, EloquentTeamsRepository::class);
    }
}
