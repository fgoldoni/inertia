<?php

namespace Modules\Jobs\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Jobs\Enums\JobState;
use Modules\Jobs\Enums\SalaryType;

class JobFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Jobs\Entities\Job::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->jobTitle,
            'phone' => $this->faker->phoneNumber,
            'view_count' => $this->faker->numberBetween(0, 100),
            'content' => $this->faker->sentence(100),
            'user_id' => $this->faker->numberBetween(1, 10),
            'country_id' => $this->faker->numberBetween(1, 200),
            'state' => $this->faker->randomElement([JobState::Draft, JobState::Published, JobState::Archived, JobState::Hold]),
            'salary_type' => $this->faker->randomElement([SalaryType::Day, SalaryType::Hour, SalaryType::Month, SalaryType::Year]),
            'closing_to' => $this->faker->dateTimeInInterval('now', '+30 days'),
            'live_at' => $this->faker->randomElement([$this->faker->dateTimeInInterval('-5 days', 'now'), null]),
            'experience' => $this->faker->numberBetween(1, 5),
            'salary_min' => $this->faker->randomElement([38000, 40000, 45000, 50000, 55000, 60000, 65000]),
            'salary_max' => $this->faker->randomElement([70000, 75000, 80000, 85000, 90000]),
        ];
    }
}

