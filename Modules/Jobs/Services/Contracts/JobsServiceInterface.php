<?php
namespace Modules\Jobs\Services\Contracts;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Modules\Jobs\Transformers\ApiJobResource;

interface JobsServiceInterface
{
    public function apiJobs(): AnonymousResourceCollection;

    public function apiJob(int $id): ApiJobResource;
}
