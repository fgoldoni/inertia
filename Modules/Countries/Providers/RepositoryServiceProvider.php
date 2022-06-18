<?php
namespace Modules\Countries\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Countries\Repositories\Contracts\CitiesRepository;
use Modules\Countries\Repositories\Contracts\CountriesRepository;
use Modules\Countries\Repositories\Contracts\DivisionsRepository;
use Modules\Countries\Repositories\Eloquent\EloquentCitiesRepository;
use Modules\Countries\Repositories\Eloquent\EloquentCountriesRepository;
use Modules\Countries\Repositories\Eloquent\EloquentDivisionsRepository;

class RepositoryServiceProvider extends ServiceProvider
{

    protected $defer = false;

    public function boot()
    {
        $this->app->bind(CountriesRepository::class, EloquentCountriesRepository::class);
        $this->app->bind(DivisionsRepository::class, EloquentDivisionsRepository::class);
        $this->app->bind(CitiesRepository::class, EloquentCitiesRepository::class);
    }
}
