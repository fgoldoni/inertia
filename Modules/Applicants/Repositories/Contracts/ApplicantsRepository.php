<?php
namespace Modules\Applicants\Repositories\Contracts;

use Illuminate\Support\Collection;

interface ApplicantsRepository
{
    public function getStates(): Collection;
}
