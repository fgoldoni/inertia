<?php

namespace Modules\Applicants\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Applicants\Enums\Status;
use Modules\Jobs\Entities\Job;
use Modules\Jobs\Enums\SalaryType;

class ApplicantFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Applicants\Entities\Applicant::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'phone' => $this->faker->phoneNumber,
            'status' => $this->faker->randomElement(
                [
                    Status::Pending,
                    Status::Approved,
                    Status::Rejected,
                ]
            ),
            'message' => $this->faker->sentence(5),
            'user_id' => 4,
            'job_id' => Job::withoutGlobalScope('team')->published()->inRandomOrder()->first()->id,
        ];
    }
}
