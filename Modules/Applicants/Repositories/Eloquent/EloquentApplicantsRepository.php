<?php

/**
 * Created by PhpStorm.
 * User: goldoni
 * Date: 24.09.18
 * Time: 21:18.
 */

namespace Modules\Applicants\Repositories\Eloquent;

use App\Repositories\RepositoryAbstract;
use Modules\Applicants\Entities\Applicant;
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
}
