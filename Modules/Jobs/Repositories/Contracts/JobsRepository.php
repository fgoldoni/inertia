<?php

namespace Modules\Jobs\Repositories\Contracts;

use Illuminate\Support\Collection;

interface JobsRepository
{
    public function getStates(): Collection;
}
