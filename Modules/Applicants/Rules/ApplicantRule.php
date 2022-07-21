<?php

namespace Modules\Applicants\Rules;

use Illuminate\Contracts\Validation\InvokableRule;
use Illuminate\Support\Facades\DB;

class ApplicantRule implements InvokableRule
{

    public function __construct(private readonly ?int $jobId = null)
    {
    }

    public function __invoke($attribute, $value, $fail)
    {
        if ($this->isExist($value)) {
            $fail('The applicant has already existed.');
        }
    }


    private function isExist($value): bool
    {
        return DB::table('applicants')->where('user_id', $value)
            ->where('job_id', $this->jobId)
            ->exists();
    }
}
