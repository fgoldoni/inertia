<?php

namespace Modules\Jobs\Services\Contracts;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

interface JobsServiceInterface
{
    public function apiJobs(): AnonymousResourceCollection;
}
