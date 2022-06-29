<?php
namespace Modules\Dashboard\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
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

        $dashboard = Dashboard::create([
            'name' => 'Jobs',
        ]);

        $dashboard->users()->attach([
            1 => [
                'x' => 0,
                'y' => 0,
                'w' => 4,
                'h' => 4,
                'component' => 'JobsComponent'
            ],
            2 => [
                'x' => 0,
                'y' => 0,
                'w' => 4,
                'h' => 4,
                'component' => 'JobsComponent'
            ],
        ]);

        $dashboard = Dashboard::create([
            'name' => 'Application',
        ]);

        $dashboard->users()->attach([
            1 => [
                'x' => 4,
                'y' => 0,
                'w' => 4,
                'h' => 4,
                'component' => 'ApplicationComponent'
            ],
            2 => [
                'x' => 4,
                'y' => 0,
                'w' => 4,
                'h' => 4,
                'component' => 'ApplicationComponent'
            ],
        ]);

        $dashboard = Dashboard::create([
            'name' => 'Review',
        ]);

        $dashboard->users()->attach([
            1 => [
                'x' => 8,
                'y' => 0,
                'w' => 4,
                'h' => 4,
                'component' => 'ReviewComponent'
            ],
            2 => [
                'x' => 8,
                'y' => 0,
                'w' => 4,
                'h' => 4,
                'component' => 'ReviewComponent'
            ],
        ]);

        $dashboard = Dashboard::create([
            'name' => 'Companies',
        ]);

        $dashboard->users()->attach([
            1 => [
                'x' => 0,
                'y' => 4,
                'w' => 4,
                'h' => 4,
                'component' => 'CompaniesComponent'
            ],
            2 => [
                'x' => 0,
                'y' => 4,
                'w' => 4,
                'h' => 4,
                'component' => 'CompaniesComponent'
            ],
        ]);

        $dashboard = Dashboard::create([
            'name' => 'Users',
        ]);

        $dashboard->users()->attach([
            1 => [
                'x' => 4,
                'y' => 4,
                'w' => 4,
                'h' => 4,
                'component' => 'UsersComponent'
            ],
            2 => [
                'x' => 4,
                'y' => 4,
                'w' => 4,
                'h' => 4,
                'component' => 'UsersComponent'
            ],
        ]);

        $dashboard = Dashboard::create([
            'name' => 'Shortlisted',
        ]);

        $dashboard->users()->attach([
            1 => [
                'x' => 8,
                'y' => 4,
                'w' => 4,
                'h' => 4,
                'component' => 'ShortlistedComponent'
            ],
            2 => [
                'x' => 8,
                'y' => 4,
                'w' => 4,
                'h' => 4,
                'component' => 'ShortlistedComponent'
            ],
        ]);

        $dashboard = Dashboard::create([
            'name' => 'Teams',
        ]);

        $dashboard->users()->attach([
            1 => [
                'x' => 0,
                'y' => 8,
                'w' => 4,
                'h' => 4,
                'component' => 'TeamsComponent'
            ],
            2 => [
                'x' => 0,
                'y' => 8,
                'w' => 4,
                'h' => 4,
                'component' => 'TeamsComponent'
            ],
        ]);


        $dashboard = Dashboard::create([
            'name' => 'Activities',
        ]);

        $dashboard->users()->attach([
            1 => [
                'x' => 4,
                'y' => 8,
                'w' => 4,
                'h' => 8,
                'component' => 'ActivitiesComponent'
            ],
            2 => [
                'x' => 4,
                'y' => 8,
                'w' => 4,
                'h' => 8,
                'component' => 'ActivitiesComponent'
            ],
        ]);

        $dashboard = Dashboard::create([
            'name' => 'JobsNotification',
        ]);

        $dashboard->users()->attach([
            1 => [
                'x' => 0,
                'y' => 16,
                'w' => 6,
                'h' => 10,
                'component' => 'JobsNotificationComponent'
            ],
            2 => [
                'x' => 0,
                'y' => 16,
                'w' => 6,
                'h' => 10,
                'component' => 'JobsNotificationComponent'
            ],
        ]);

        $dashboard = Dashboard::create([
            'name' => 'RegisteredWithinDays',
        ]);

        $dashboard->users()->attach([
            1 => [
                'x' => 6,
                'y' => 16,
                'w' => 6,
                'h' => 10,
                'component' => 'RegisteredWithinDaysComponent'
            ],
            2 => [
                'x' => 6,
                'y' => 16,
                'w' => 6,
                'h' => 10,
                'component' => 'RegisteredWithinDaysComponent'
            ],
        ]);


    }
}
