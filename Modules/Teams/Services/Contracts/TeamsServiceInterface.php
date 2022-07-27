<?php

namespace Modules\Teams\Services\Contracts;

use App\Models\Team;
use Illuminate\Support\Collection;
use Modules\Teams\Transformers\TeamResource;

interface TeamsServiceInterface
{
    public function findTeam(int $id): TeamResource;

    public function colors(): Collection;

    public function allOptionsTeams();

    public function create(array $attributes): Team;
}
