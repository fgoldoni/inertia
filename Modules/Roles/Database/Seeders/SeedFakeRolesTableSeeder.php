<?php

namespace Modules\Roles\Database\Seeders;

use App\Traits\Database\DisableForeignKeys;
use App\Traits\Database\TruncateTable;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Modules\Roles\Entities\Role;

class SeedFakeRolesTableSeeder extends Seeder
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

        Role::create([
            'name' => config('app.system.users.roles.administrator'),
            'display_name' => Str::title(config('app.system.users.roles.administrator')),
            'description' => 'Site administrator with access to shop admin panel and developer tools.',
            'can_be_removed' => false,
        ]);

        Role::create([
            'name' => config('app.system.users.roles.manager'),
            'display_name' => Str::title(config('app.system.users.roles.manager')),
            'description' => 'Site manager with access to shop admin panel and publishing menus.',
            'can_be_removed' => false,
        ]);

        Role::create([
            'name' => config('app.system.users.roles.default'),
            'display_name' => Str::title(config('app.system.users.roles.default')),
            'description' => 'Site customer role with access on front site.',
            'can_be_removed' => false,
        ]);

        $this->enableForeignKeys();
    }
}
