<?php

namespace Modules\Tags\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Modules\Tags\Entities\Tag;

class TagsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     *
     * @throws \Exception
     */
    public function run()
    {
        Model::unguard();

        Tag::factory(200)->create()->each(function ($tag) {
            $tag->jobs()->sync([random_int(1, 25), random_int(25, 50), random_int(50, 75), random_int(75, 100)]);
        });
    }
}
