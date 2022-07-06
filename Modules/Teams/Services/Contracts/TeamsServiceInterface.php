<?php

namespace Modules\Teams\Services\Contracts;

use Modules\Teams\Transformers\TeamResource;

interface TeamsServiceInterface
{
    public function findTeam(int $id): TeamResource;
}
