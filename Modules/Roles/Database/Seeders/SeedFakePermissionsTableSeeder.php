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

        Permission::query()->create([
            'name' => 'access_dashboard',
            'group_name' => 'system',
            'display_name' => __('Access Dashboard'),
            'description' => __('This permission allow user to access to the dashboard.'),
            'can_be_removed' => false,
        ]);

        Permission::query()->create([
            'name' => 'impersonate',
            'group_name' => 'system',
            'display_name' => __('Impersonate User'),
            'description' => __('This permission allow user to logged with the account of another user.'),
            'can_be_removed' => false,
        ]);

        Permission::generate('brands');
        Permission::generate('roles');
        Permission::generate('users');
        Permission::generate('categories');
        Permission::generate('countries');
        Permission::generate('attachments');
        Permission::generate('companies');
        Permission::generate('jobs');

        $this->enableForeignKeys();
    }
}
