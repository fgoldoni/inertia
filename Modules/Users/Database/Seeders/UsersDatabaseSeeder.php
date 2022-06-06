<?php
namespace Modules\Users\Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SeedFakeUsersTableSeeder::class);
    }
}
