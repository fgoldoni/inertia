<?php

namespace Modules\Comments\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Applicants\Entities\Applicant;
use Modules\Comments\Entities\Comment;

class CommentsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        Comment::withoutEvents(function () {
            Comment::factory(15)->create(['commentable_type' => Applicant::class]);
            Comment::factory(50)->create([
                'commentable_type' => Applicant::class,
                'reply' => random_int(1, 10)
            ]);
        });
    }
}
