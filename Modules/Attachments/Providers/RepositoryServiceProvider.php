<?php
namespace Modules\Attachments\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Attachments\Repositories\Contracts\AttachmentsRepository;
use Modules\Attachments\Repositories\Eloquent\EloquentAttachmentsRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    protected $defer = false;

    public function boot()
    {
        $this->app->bind(AttachmentsRepository::class, EloquentAttachmentsRepository::class);
    }
}
