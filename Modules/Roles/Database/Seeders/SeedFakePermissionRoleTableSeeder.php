<?php
namespace Modules\Roles\Database\Seeders;

use App\Traits\Database\DisableForeignKeys;
use App\Traits\Database\TruncateTable;
use Illuminate\Database\Seeder;
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
        $this->disableForeignKeys();

        $administrator = Role::query()->where('name', config('app.system.users.roles.administrator'))->firstOrFail();

        $permissions = Permission::all();

        $administrator->permissions()->sync($permissions->pluck('id')->all());

        $manager = Role::query()->where('name', config('app.system.users.roles.manager'))->firstOrFail();

        $permissions = Permission::where('group_name', 'teams')->get();

        $manager->permissions()->attach($permissions->pluck('id')->all());

        $permissions = Permission::where('group_name', 'applicants')->get();

        $manager->permissions()->attach($permissions->pluck('id')->all());

        $permissions = Permission::where('group_name', 'comments')->get();

        $manager->permissions()->attach($permissions->pluck('id')->all());

        $permissions = Permission::where('group_name', 'resumes')->get();

        $manager->permissions()->attach($permissions->pluck('id')->all());

        $default = Role::query()->where('name', config('app.system.users.roles.default'))->firstOrFail();

        $permissions = Permission::where('group_name', 'applicants')->get();

        $default->permissions()->attach($permissions->pluck('id')->all());

        $permissions = Permission::where('group_name', 'comments')->get();

        $default->permissions()->attach($permissions->pluck('id')->all());

        $permissions = Permission::where('group_name', 'resumes')->get();

        $default->permissions()->attach($permissions->pluck('id')->all());

        $this->enableForeignKeys();
    }
}
