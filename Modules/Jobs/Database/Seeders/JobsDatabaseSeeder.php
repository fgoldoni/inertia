<?php
namespace Modules\Jobs\Database\Seeders;

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
        Job::factory(100)->state(function (array $attributes) {
            $city = City::where('country_id', $attributes['country_id'])->inRandomOrder()->first();

            $division = Division::where('country_id', $attributes['country_id'])->inRandomOrder()->first();

            if ($city) {
                return ['city_id' => $city->id];
            } else {
                if ($division) {
                    return ['division_id' => $division->id];
                }
            }

            return [];
        })->create(['live_at' => $faker->dateTimeInInterval('now', '-1 days')])->each(function ($job) {
            $this->syncCategories($job);

            $job->company_id = Company::where('user_id', $job->user_id)->inRandomOrder()->first()?->id;

            $job->save();
        });

        Job::factory(100)->state(function (array $attributes) {
            $city = City::where('country_id', $attributes['country_id'])->inRandomOrder()->first();
            $division = Division::where('country_id', $attributes['country_id'])->inRandomOrder()->first();

            if ($city) {
                return ['city_id' => $city->id];
            } else {
                if ($division) {
                    return ['division_id' => $division->id];
                }
            }

            return [];
        })->create(['live_at' => $faker->dateTimeInInterval('-1 days', '-2 days')])->each(function ($job) {
            $this->syncCategories($job);
        });

        Job::factory(100)->state(function (array $attributes) {
            $city = City::where('country_id', $attributes['country_id'])->inRandomOrder()->first();
            $division = Division::where('country_id', $attributes['country_id'])->inRandomOrder()->first();

            if ($city) {
                return ['city_id' => $city->id];
            } else {
                if ($division) {
                    return ['division_id' => $division->id];
                }
            }

            return [];
        })->create(['live_at' => $faker->dateTimeInInterval('-2 days', '-7 days')]);

        Job::factory(100)->state(function (array $attributes) {
            $city = City::where('country_id', $attributes['country_id'])->inRandomOrder()->first();
            $division = Division::where('country_id', $attributes['country_id'])->inRandomOrder()->first();

            if ($city) {
                return ['city_id' => $city->id];
            } else {
                if ($division) {
                    return ['division_id' => $division->id];
                }
            }

            return [];
        })->create(['live_at' => $faker->dateTimeInInterval('-7 days', '-30 days')])->each(function ($job) {
            $this->syncCategories($job);
        });

        Job::factory(100)->state(function (array $attributes) {
            $city = City::where('country_id', $attributes['country_id'])->inRandomOrder()->first();
            $division = Division::where('country_id', $attributes['country_id'])->inRandomOrder()->first();

            if ($city) {
                return ['city_id' => $city->id];
            } else {
                if ($division) {
                    return ['division_id' => $division->id];
                }
            }
            return [];
        })->create(['live_at' => $faker->dateTimeInInterval('-30 days', '-60 days')])->each(function ($job) {
            $this->syncCategories($job);
        });
    }

    private function syncCategories(Job $job)
    {
        $area = Category::area()->limit(10)->inRandomOrder()->first();

        $industry = Category::industry()->limit(10)->inRandomOrder()->first();

        $jobType = Category::type(CategoryType::JobType)->inRandomOrder()->first();

        $jobLevel = Category::type(CategoryType::JobLevel)->inRandomOrder()->first();

        $gender = Category::type(CategoryType::Gender)->inRandomOrder()->first();

        $responsibility = Category::type(CategoryType::Responsibility)->inRandomOrder()->first();

        $skill = Category::type(CategoryType::Skill)->inRandomOrder()->first();

        $benefit = Category::type(CategoryType::Benefit)->inRandomOrder()->first();

        $experience = Category::type(CategoryType::Experience)->inRandomOrder()->first();

        $careerLevel = Category::type(CategoryType::CareerLevel)->inRandomOrder()->first();

        $applyType = Category::type(CategoryType::ApplyType)->inRandomOrder()->first();

        $job->syncCategories([$area->id, $industry->id, $jobType->id, $jobLevel->id, $gender->id, $responsibility->id, $skill->id, $benefit->id, $experience->id, $careerLevel->id, $applyType->id], false);
    }
}
