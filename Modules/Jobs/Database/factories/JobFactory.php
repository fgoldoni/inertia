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
        $userId = $this->faker->numberBetween(1, 5);

        return [
            'name' => $this->faker->jobTitle,
            'phone' => $this->faker->phoneNumber,
            'view_count' => $this->faker->numberBetween(0, 100),
            'content' => $this->faker->sentence(100),
            'user_id' => $userId,
            'country_id' => $this->faker->numberBetween(1, 200),
            'state' => $this->faker->randomElement([JobState::Draft, JobState::Published, JobState::Archived, JobState::Hold]),
            'salary_type' => $this->faker->randomElement([SalaryType::Day, SalaryType::Hour, SalaryType::Month, SalaryType::Year]),
            'closing_to' => $this->faker->dateTimeInInterval('now', '+7 days'),
            'live_at' => $this->faker->randomElement([$this->faker->dateTimeInInterval('-5 days', 'now'), null]),
            'salary_min' => $this->faker->randomElement([38000, 40000, 45000, 50000, 55000, 60000, 65000]),
            'salary_max' => $this->faker->randomElement([70000, 75000, 80000, 85000, 90000]),
            'address' => $this->faker->address,
            'zip' => $this->faker->postcode,
            'iframe' => '<div class="mapouter"><div class="gmap_canvas"><iframe width="350" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=2880%20Broadway,%20New%20York&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><br><style>.mapouter{position:relative;text-align:right;height:500px;width:350px;}</style><a href="https://www.embedgooglemap.net">google map coding</a><style>.gmap_canvas {overflow:hidden;background:none!important;height:500px;width:350px;}</style></div></div>',
        ];
    }
}
