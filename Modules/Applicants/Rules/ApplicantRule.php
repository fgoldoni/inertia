<?php

namespace Modules\Applicants\Rules;

use Illuminate\Contracts\Validation\InvokableRule;
use Illuminate\Support\Facades\DB;

class ApplicantRule implements InvokableRule
{

    private ?int $jobId;

    public function __construct(?int $jobId = null)
    {
        $this->jobId = $jobId;
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
