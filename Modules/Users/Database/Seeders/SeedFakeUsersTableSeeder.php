<?php
namespace Modules\Users\Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

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

        $user = User::factory()->withPersonalTeam()->create(['name' => 'Admin SG', 'email' => 'admin@admin.com']);

        $user->assignRole(config('app.system.users.roles.administrator'));

        $user = User::factory()->withPersonalTeam()->create(['name' => 'Manager SG', 'trial_ends_at' => now()->addDays(14), 'email' => 'fotsa.goldoni@yahoo.fr']);

        $user->assignRole(config('app.system.users.roles.manager'));

        $users = User::factory(10)->withPersonalTeam()->create(['trial_ends_at' => now()->addDays(14)]);

        foreach ($users as $user) {
            $user->assignRole(config('app.system.users.roles.manager'));
        }

        $users = User::factory(20)->create();

        foreach ($users as $user) {
            $user->assignRole(config('app.system.users.roles.default'));
        }
    }
}
