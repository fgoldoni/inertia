<?php

namespace Modules\Companies\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Companies\Enums\CompanyState;

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
        return [
            'name' => $this->faker->company,
            'content' => $this->faker->sentence,
            'email' => $this->faker->email,
            'phone' => $this->faker->phoneNumber,
            'user_id' => $this->faker->numberBetween(1, 10),
            'online' =>  $this->faker->boolean,
        ];
    }
}

