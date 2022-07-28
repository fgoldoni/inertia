<?php

namespace Modules\Users\Database\Seeders;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Modules\Teams\Repositories\Contracts\TeamsRepository;

class SeedFakeUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $administrator = User::factory()
            ->withPersonalTeam()->create(['name' => 'Admin SG', 'email' => 'admin@admin.com']);

        Team::where('id', $administrator->currentTeam->id)
            ->first()
            ->update(['subdomain' => 'netflix', 'display_name' => 'Netflix', 'color' => 'red']);

        $administrator->assignRole(config('app.system.users.roles.administrator'));

        $manager = User::factory()
            ->withPersonalTeam()
            ->create([
                'name' => 'Manager SG',
                'trial_ends_at' => now()->addDays(14),
                'email' => 'manager@manager.com',
            ]);

        Team::where('id', $manager->currentTeam->id)
            ->first()
            ->update(['subdomain' => 'deutsche-bank', 'display_name' => 'Deutsche Bank', 'color' => 'blue']);

        $manager->assignRole(config('app.system.users.roles.manager'));

        $goldoni = User::factory()
            ->withPersonalTeam()
            ->create([
                'name' => 'Goldoni Fouotsa',
                'trial_ends_at' => now()->addDays(14),
                'email' => 'fotsa.goldoni@yahoo.fr',
            ]);

        Team::where('id', $goldoni->currentTeam->id)
            ->first()
            ->update(['subdomain' => 'tesla', 'display_name' => 'Tesla', 'color' => 'stone']);

        $goldoni->assignRole(config('app.system.users.roles.manager'));

        $user = User::factory()->withPersonalTeam()->create([
            'name' => 'User SG',
            'trial_ends_at' => now()->addDays(14),
            'email' => 'user@user.com',
        ]);

        $user->assignRole(config('app.system.users.roles.default'));

         app()->make(TeamsRepository::class)->attachUser($administrator->currentTeam, $user);

         app()->make(TeamsRepository::class)->attachUser($manager->currentTeam, $user);

         app()->make(TeamsRepository::class)->attachUser($goldoni->currentTeam, $user);

        $users = User::factory(2)->withPersonalTeam()->create();

        foreach ($users as $user) {
            $user->assignRole(config('app.system.users.roles.default'));
        }
    }
}
