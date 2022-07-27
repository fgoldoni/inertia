<?php

namespace Modules\Comments\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Comments\Repositories\Contracts\CommentsRepository;
use Modules\Comments\Repositories\Eloquent\EloquentCommentsRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    protected $defer = false;

    public function boot()
    {
        $this->app->bind(CommentsRepository::class, EloquentCommentsRepository::class);
    }
}
