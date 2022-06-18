<?php
namespace Modules\Countries\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Countries\Repositories\Contracts\CountriesRepository;
use Modules\Countries\Repositories\Eloquent\EloquentCountriesRepository;

class RepositoryServiceProvider extends ServiceProvider
{

    protected $defer = false;

    public function boot()
    {
        $this->app->bind(CountriesRepository::class, EloquentCountriesRepository::class);
    }
}
