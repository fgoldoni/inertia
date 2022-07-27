<?php
namespace Modules\Tags\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Tags\Entities\Tag;

class TagsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws \Exception
     */
    public function run()
    {
        Model::unguard();

        Tag::factory(200)->create()->each(function ($tag) {
            $tag->jobs()->sync([random_int(1, 50), random_int(50, 100), random_int(1, 50), random_int(50, 100)]);
        });
    }
}
