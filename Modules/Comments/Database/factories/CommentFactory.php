<?php

namespace Modules\Comments\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Comments\Entities\Comment;
use Modules\Jobs\Entities\Job;

class CommentFactory extends Factory
{
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $userId = $this->faker->numberBetween(1, 5);

        return [
            'content' => $this->faker->sentence(10),
            'commentable_type' => Job::class,
            'commentable_id' => $this->faker->numberBetween(1, 10),
            'user_id' => $userId,
        ];
    }
}
