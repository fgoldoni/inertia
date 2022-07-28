<?php

namespace Modules\Applicants\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Event;
use Modules\Applicants\Entities\Applicant;

class ApplicantsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        Event::fake();

        Applicant::factory(30)->create();
    }
}
