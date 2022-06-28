<?php
namespace Modules\Dashboard\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Modules\Dashboard\Entities\Dashboard;

class DashboardDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $d = Dashboard::create([
            'name' => 'Jobs',
            'x' => 0,
            'y' => 0,
            'w' => 2,
            'h' => 2,
            'i' => 0,
            'component' => 'JobsComponent',
        ]);

        $d->users()->attach([1, 2, 3]);



        DB::table('dashboards')->insert([
            'name' => 'Application',
            'x' => 2,
            'y' => 0,
            'w' => 2,
            'h' => 2,
            'i' => 1,
            'component' => 'ApplicationComponent',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('dashboards')->insert([
            'name' => 'Review',
            'x' => 4,
            'y' => 0,
            'w' => 2,
            'h' => 2,
            'i' => 2,
            'component' => 'ReviewComponent',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('dashboards')->insert([
            'name' => 'Companies',
            'x' => 0,
            'y' => 4,
            'w' => 2,
            'h' => 2,
            'i' => 3,
            'component' => 'CompaniesComponent',
            'created_at' => now(),
            'updated_at' => now()
        ]);


        DB::table('dashboards')->insert([
            'name' => 'Users',
            'x' => 6,
            'y' => 0,
            'w' => 2,
            'h' => 2,
            'i' => 4,
            'component' => 'UsersComponent',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('dashboards')->insert([
            'name' => 'Shortlisted',
            'x' => 8,
            'y' => 0,
            'w' => 2,
            'h' => 2,
            'i' => 5,
            'component' => 'ShortlistedComponent',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('dashboards')->insert([
            'name' => 'Teams',
            'x' => 0,
            'y' => 2,
            'w' => 2,
            'h' => 2,
            'i' => 6,
            'component' => 'TeamsComponent',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
