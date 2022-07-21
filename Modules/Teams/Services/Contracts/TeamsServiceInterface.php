<?php
namespace Modules\Teams\Services\Contracts;

use Illuminate\Support\Collection;
use Modules\Teams\Transformers\TeamResource;

interface TeamsServiceInterface
{
    public function findTeam(int $id): TeamResource;

    public function colors(): Collection;

    public function allOptionsTeams();
}
