<?php

namespace Modules\Companies\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Modules\Categories\Entities\Category;
use Modules\Companies\Entities\Company;

class CompaniesDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        Company::factory(100)->create();
    }

    private function syncCategories(Company $company)
    {
        $industry = Category::industry()->limit(10)->inRandomOrder()->first();

        $company->syncCategories([
            $industry->id,
        ], false);
    }
}
