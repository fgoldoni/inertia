<?php
namespace Modules\Jobs\Repositories\Contracts;

use Illuminate\Support\Collection;

interface JobsRepository
{
    public function getStates(): Collection;

    public function salaryTypes(): Collection;

    public function initCategories($categories): array;
}
