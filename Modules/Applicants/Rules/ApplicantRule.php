<?php

namespace Modules\Applicants\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class ApplicantRule implements Rule
{
    private int $user_id;
    private int $job_id;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(int $user_id, int $job_id)
    {
        $this->user_id = $user_id;
        $this->job_id = $job_id;
    }


    public function passes($attribute, $value)
    {
        return !DB::table('applicants')->where('user_id', $this->user_id)
            ->where('job_id', $this->job_id)
            ->exists();
    }


    public function message()
    {
        return __('The applicant has already existed.');
    }
}
