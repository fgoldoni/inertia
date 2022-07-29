<?php
namespace Modules\Jobs\Services\Contracts;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Collection;
use Modules\Jobs\Transformers\ApiJobResource;

interface JobsServiceInterface
{
    public function apiJobs(): AnonymousResourceCollection;

    public function apiJob(int $id): ApiJobResource;

    public function search(Request $request): Collection;
}
