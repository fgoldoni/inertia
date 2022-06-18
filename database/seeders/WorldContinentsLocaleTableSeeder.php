<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class WorldContinentsLocaleTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('world_continents_locale')->truncate();

        \DB::table('world_continents_locale')->insert([
            0 => [
                'id' => 1,
                'continent_id' => 1,
                'name' => '亚洲',
                'alias' => null,
                'abbr' => '亚',
                'full_name' => null,
                'locale' => 'zh-cn',
            ],
            1 => [
                'id' => 2,
                'continent_id' => 2,
                'name' => '欧洲',
                'alias' => null,
                'abbr' => '欧',
                'full_name' => null,
                'locale' => 'zh-cn',
            ],
            2 => [
                'id' => 3,
                'continent_id' => 3,
                'name' => '非洲',
                'alias' => null,
                'abbr' => '非',
                'full_name' => null,
                'locale' => 'zh-cn',
            ],
            3 => [
                'id' => 4,
                'continent_id' => 4,
                'name' => '大洋洲',
                'alias' => null,
                'abbr' => '大洋',
                'full_name' => null,
                'locale' => 'zh-cn',
            ],
            4 => [
                'id' => 5,
                'continent_id' => 5,
                'name' => '南极洲',
                'alias' => null,
                'abbr' => '南极',
                'full_name' => null,
                'locale' => 'zh-cn',
            ],
            5 => [
                'id' => 6,
                'continent_id' => 6,
                'name' => '北美洲',
                'alias' => null,
                'abbr' => '北美',
                'full_name' => null,
                'locale' => 'zh-cn',
            ],
            6 => [
                'id' => 7,
                'continent_id' => 7,
                'name' => '南美洲',
                'alias' => null,
                'abbr' => '南美',
                'full_name' => null,
                'locale' => 'zh-cn',
            ],
            7 => [
                'id' => 8,
                'continent_id' => 1,
                'name' => 'Asia',
                'alias' => null,
                'abbr' => 'as',
                'full_name' => null,
                'locale' => 'en',
            ],
            8 => [
                'id' => 9,
                'continent_id' => 2,
                'name' => 'Europe',
                'alias' => null,
                'abbr' => 'eu',
                'full_name' => null,
                'locale' => 'en',
            ],
            9 => [
                'id' => 10,
                'continent_id' => 3,
                'name' => 'Africa',
                'alias' => null,
                'abbr' => 'af',
                'full_name' => null,
                'locale' => 'en',
            ],
            10 => [
                'id' => 11,
                'continent_id' => 4,
                'name' => 'Oceania',
                'alias' => null,
                'abbr' => 'oc',
                'full_name' => null,
                'locale' => 'en',
            ],
            11 => [
                'id' => 12,
                'continent_id' => 5,
                'name' => 'Antarctica',
                'alias' => null,
                'abbr' => 'an',
                'full_name' => null,
                'locale' => 'en',
            ],
            12 => [
                'id' => 13,
                'continent_id' => 6,
                'name' => 'North America',
                'alias' => null,
                'abbr' => 'na',
                'full_name' => null,
                'locale' => 'en',
            ],
            13 => [
                'id' => 14,
                'continent_id' => 7,
                'name' => 'South America',
                'alias' => null,
                'abbr' => 'sa',
                'full_name' => null,
                'locale' => 'en',
            ],
            14 => [
                'id' => 15,
                'continent_id' => 7,
                'name' => 'Amérique du sud',
                'alias' => null,
                'abbr' => null,
                'full_name' => 'Amérique du sud',
                'locale' => 'fr',
            ],
            15 => [
                'id' => 16,
                'continent_id' => 6,
                'name' => 'Amérique du nord',
                'alias' => null,
                'abbr' => null,
                'full_name' => 'Amérique du nord',
                'locale' => 'fr',
            ],
            16 => [
                'id' => 17,
                'continent_id' => 5,
                'name' => 'Antarctique',
                'alias' => null,
                'abbr' => null,
                'full_name' => 'Antarctique',
                'locale' => 'fr',
            ],
            17 => [
                'id' => 18,
                'continent_id' => 4,
                'name' => 'Océanie',
                'alias' => null,
                'abbr' => null,
                'full_name' => 'Océanie',
                'locale' => 'fr',
            ],
            18 => [
                'id' => 19,
                'continent_id' => 3,
                'name' => 'Afrique',
                'alias' => null,
                'abbr' => null,
                'full_name' => 'Afrique',
                'locale' => 'fr',
            ],
            19 => [
                'id' => 20,
                'continent_id' => 2,
                'name' => 'Europe',
                'alias' => null,
                'abbr' => null,
                'full_name' => 'Europe',
                'locale' => 'fr',
            ],
            20 => [
                'id' => 21,
                'continent_id' => 1,
                'name' => 'Asie',
                'alias' => null,
                'abbr' => null,
                'full_name' => 'Asie',
                'locale' => 'fr',
            ],
        ]);
    }
}
