<?php
namespace Modules\Roles\Database\Seeders;

use App\Traits\Database\DisableForeignKeys;
use App\Traits\Database\TruncateTable;
use Illuminate\Database\Seeder;
use Modules\Roles\Entities\Permission;

class SeedFakePermissionsTableSeeder extends Seeder
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

        Permission::generate('roles');
        Permission::generate('users');
        Permission::generate('categories');
        Permission::generate('companies');
        Permission::generate('jobs');

        $this->enableForeignKeys();
    }
}
