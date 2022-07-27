<?php
namespace Modules\Roles\Database\Seeders;

use App\Models\User;
use App\Traits\Database\DisableForeignKeys;
use App\Traits\Database\TruncateTable;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Event;
use Modules\Roles\Entities\Permission;
use Modules\Roles\Entities\Role;

class SeedFakePermissionRoleTableSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Event::fake();

        $this->disableForeignKeys();

        $administrator = Role::query()->where('name', config('app.system.users.roles.administrator'))->firstOrFail();

        $permissions = Permission::all();

        $administrator->permissions()->sync($permissions->pluck('id')->all());

        $manager = Role::query()->where('name', config('app.system.users.roles.manager'))->firstOrFail();

        $this->attachPermission($manager, [
            'system',
            'teams',
            'jobs',
            'applicants',
            'comments',
            'resumes',
        ]);

        $default = Role::query()->where('name', config('app.system.users.roles.default'))->firstOrFail();

        $this->attachPermission($default, [
            'applicants',
            'comments',
            'resumes',
        ]);

        $this->enableForeignKeys();
    }

    private function attachPermission(Role $role, array $groups): Role
    {
        foreach ($groups as $group) {
            $permissions = Permission::where('group_name', $group)->get();

            $role->permissions()->attach($permissions->pluck('id')->all());
        }

        return $role;
    }
}
