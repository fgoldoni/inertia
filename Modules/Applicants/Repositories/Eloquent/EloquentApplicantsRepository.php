<?php

/**
 * Created by PhpStorm.
 * User: goldoni
 * Date: 24.09.18
 * Time: 21:18.
 */
namespace Modules\Applicants\Repositories\Eloquent;

use App\Repositories\RepositoryAbstract;
use Illuminate\Support\Collection;
use Modules\Applicants\Entities\Applicant;
use Modules\Applicants\Enums\Status;
use Modules\Applicants\Repositories\Contracts\ApplicantsRepository;

/**
 * Class EloquentPostsRepository.
 */
class EloquentApplicantsRepository extends RepositoryAbstract implements ApplicantsRepository
{
    public function model(): string
    {
        return Applicant::class;
    }

    public function getStates(): Collection
    {
        return collect([
            [
                'id' => (Status::Approved)->value,
                'name' => ucfirst((Status::Approved)->value),
            ],

            [
                'id' => (Status::Pending)->value,
                'name' => ucfirst((Status::Pending)->value),
            ],

            [
                'id' => (Status::Rejected)->value,
                'name' => ucfirst((Status::Rejected)->value),
            ],
        ]);
    }
}
