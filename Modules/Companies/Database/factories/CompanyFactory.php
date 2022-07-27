<?php

namespace Modules\Companies\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Companies\Entities\Company::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $userId = $this->faker->numberBetween(1, 10);

        return [
            'name' => $this->faker->company,
            'slug' => $this->faker->slug,
            'content' => $this->faker->sentence,
            'email' => $this->faker->email,
            'phone' => $this->faker->phoneNumber,
            'website' => $this->faker->url,
            'size' => $this->faker->numberBetween(1, 20).' - '.$this->faker->numberBetween(20, 40),
            'founded' => $this->faker->year,
            'location' => $this->faker->country,
            'online' => $this->faker->boolean,
            'user_id' => $userId,
            'team_id' => $userId,
        ];
    }
}
