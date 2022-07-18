<?php
namespace Modules\Applicants\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Jobs\Entities\Job;

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

        $job = Job::withoutGlobalScope('team')->first();

        $job->candidates()->attach([
            14 => [
                'phone' => '+4917777777777',
                'message' => 'message',
            ],
            15 => [
                'phone' => '+4917777777777',
                'message' => 'message',
            ],
            16 => [
                'phone' => '+4917777777777',
                'message' => 'message',
            ],
        ]);
    }
}
