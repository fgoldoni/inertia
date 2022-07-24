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
            Comment::factory(25)->create(['commentable_type' => Applicant::class])->each(function ($comment) {
                Comment::factory(random_int(1, 3))->create([
                    'commentable_type' => $comment->commentable_type,
                    'commentable_id' => $comment->commentable_id,
                    'reply' => $comment->id
                ]);
            });
        });
    }
}
