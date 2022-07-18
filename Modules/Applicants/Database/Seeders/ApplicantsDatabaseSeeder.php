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
            1 => [
                'phone' => 000000000,
                'message' => 'message',
            ],
            2 => [
                'phone' => 000000000,
                'message' => 'message',
            ],
            3 => [
                'phone' => 000000000,
                'message' => 'message',
            ],
        ]);
    }
}
