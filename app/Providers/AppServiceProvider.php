<?php
namespace App\Providers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\ServiceProvider;
use Inertia\ResponseFactory;
use Modules\Attachments\Providers\AttachmentsServiceProvider;
use Modules\Categories\Providers\CategoriesServiceProvider;
use Modules\Companies\Providers\CompaniesServiceProvider;
use Modules\Jobs\Providers\JobsServiceProvider;
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
        $this->app->register(CategoriesServiceProvider::class);
        $this->app->register(AttachmentsServiceProvider::class);
        $this->app->register(CompaniesServiceProvider::class);
        $this->app->register(JobsServiceProvider::class);
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

        JsonResponse::macro('flash', fn ($message) => [
            'style' => 'success',
            'message' => session()->flash('success', $message),
        ]);

        RedirectResponse::macro('flash', function ($message) {
            return $this->with('flash', [
                'style' => 'success',
                'message' => session()->flash('success', $message),
            ]);
        });
    }
}
