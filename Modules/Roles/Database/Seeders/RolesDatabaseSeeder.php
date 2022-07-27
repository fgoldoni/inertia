<?php

namespace Modules\Roles\Database\Seeders;

use App\Traits\Database\DisableForeignKeys;
use App\Traits\Database\TruncateTable;
use Illuminate\Database\Seeder;

class RolesDatabaseSeeder extends Seeder
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

        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $this->truncateMultiple([
            config('permission.table_names.model_has_permissions'),
            config('permission.table_names.model_has_roles'),
            config('permission.table_names.role_has_permissions'),
            config('permission.table_names.permissions'),
            config('permission.table_names.roles'),
            'users',
        ]);

        $this->call(SeedFakeRolesTableSeeder::class);
        $this->call(SeedFakePermissionsTableSeeder::class);
        $this->call(SeedFakePermissionRoleTableSeeder::class);

        $this->enableForeignKeys();
    }
}
