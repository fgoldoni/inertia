<?php

namespace App\Providers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\ServiceProvider;
use Inertia\ResponseFactory;
use Modules\Activities\Providers\ActivitiesServiceProvider;
use Modules\Applicants\Providers\ApplicantsServiceProvider;
use Modules\Attachments\Providers\AttachmentsServiceProvider;
use Modules\Categories\Providers\CategoriesServiceProvider;
use Modules\Comments\Providers\CommentsServiceProvider;
use Modules\Companies\Providers\CompaniesServiceProvider;
use Modules\Dashboard\Providers\DashboardServiceProvider;
use Modules\Jobs\Providers\JobsServiceProvider;
use Modules\Resumes\Providers\ResumesServiceProvider;
use Modules\Roles\Providers\RolesServiceProvider;
use Modules\Tags\Providers\TagsServiceProvider;
use Modules\Teams\Providers\TeamsServiceProvider;
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
        $this->app->register(DashboardServiceProvider::class);
        $this->app->register(ActivitiesServiceProvider::class);
        $this->app->register(TagsServiceProvider::class);
        $this->app->register(TeamsServiceProvider::class);
        $this->app->register(ApplicantsServiceProvider::class);
        $this->app->register(ResumesServiceProvider::class);
        $this->app->register(CommentsServiceProvider::class);
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

        RedirectResponse::macro('flash', fn ($message) => $this->with('flash', [
            'style' => 'success',
            'message' => session()->flash('success', $message),
        ]));
    }
}
