<?php
namespace Modules\Jobs\Database\Seeders;

use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Modules\Categories\Entities\Category;
use Modules\Categories\Enums\CategoryType;
use Modules\Companies\Entities\Company;
use Modules\Countries\Entities\City;
use Modules\Countries\Entities\Division;
use Modules\Jobs\Entities\Job;

class JobsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        Job::factory(200)->state(function (array $attributes) {
            $city = City::where('country_id', $attributes['country_id'])->inRandomOrder()->first();

            $division = Division::where('country_id', $attributes['country_id'])->inRandomOrder()->first();

            $user = User::find($attributes['user_id']);

            if ($city) {
                return ['city_id' => $city->id, 'team_id' => $user->currentTeam()->first()->id];
            } else {
                if ($division) {
                    return ['division_id' => $division->id, 'team_id' => $user->currentTeam()->first()->id];
                }
            }

            return ['team_id' => $user->currentTeam()->first()->id];
        })->create(['live_at' => $faker->dateTimeInInterval('now', '-10 days')])->each(function ($job) {

            $this->syncCategories($job);

            $job->company_id = Company::allTeams()->where('team_id', $job->team_id)->inRandomOrder()->first()?->id;

            $job->save();
        });
    }

    private function syncCategories(Job $job)
    {
        $area = Category::area()->limit(10)->inRandomOrder()->first();

        $jobType = Category::type(CategoryType::JobType)->inRandomOrder()->first();

        $jobLevel = Category::type(CategoryType::JobLevel)->inRandomOrder()->first();

        $gender = Category::type(CategoryType::Gender)->inRandomOrder()->first();

        $responsibility = Category::type(CategoryType::Responsibility)->inRandomOrder()->first();

        $skill = Category::type(CategoryType::Skill)->inRandomOrder()->first();

        $benefit = Category::type(CategoryType::Benefit)->inRandomOrder()->first();

        $experience = Category::type(CategoryType::Experience)->inRandomOrder()->first();

        $careerLevel = Category::type(CategoryType::CareerLevel)->inRandomOrder()->first();

        $applyType = Category::type(CategoryType::ApplyType)->inRandomOrder()->first();

        $job->syncCategories([
            $area->id,
            $jobType->id,
            $jobLevel->id,
            $gender->id,
            $responsibility->id,
            $skill->id,
            $benefit->id,
            $experience->id,
            $careerLevel->id,
            $applyType->id
        ], false);
    }
}
