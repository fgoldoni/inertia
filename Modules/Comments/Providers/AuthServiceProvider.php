<?php

namespace Modules\Comments\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Modules\Comments\Entities\Comment;
use Modules\Comments\Policies\CommentPolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Comment::class => CommentPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
