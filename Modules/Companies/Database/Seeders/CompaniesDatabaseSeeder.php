<?php
namespace Modules\Companies\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Categories\Entities\Category;
use Modules\Categories\Enums\CategoryType;
use Modules\Companies\Entities\Company;
use Modules\Jobs\Entities\Job;

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
            $industry->id
        ], false);
    }
}
