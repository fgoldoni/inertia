<?php
namespace App\Providers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\ServiceProvider;
use Inertia\ResponseFactory;
use Modules\Roles\Providers\RolesServiceProvider;
use Modules\Users\Providers\UsersServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(UsersServiceProvider::class);
        $this->app->register(RolesServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        JsonResource::withoutWrapping();

        ResponseFactory::macro('modal', function ($modal) {
            inertia()->share(['modal' => $modal]);
        });

        ResponseFactory::macro('basePageRoute', function ($modal) {
            inertia()->share(['basePageRoute' => $modal]);
        });

        JsonResponse::macro('flash', fn($message) => [
            'style' => 'success',
            'message' => session()->flash('success', $message),
        ]);
    }
}
