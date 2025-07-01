<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Country;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = [
            [
                'name' => 'آمریکا',
                'name_en' => 'United States',
                'code' => 'USA',
                'flag' => '🇺🇸',
                'sort_order' => 1
            ],
            [
                'name' => 'آلمان',
                'name_en' => 'Germany',
                'code' => 'DEU',
                'flag' => '🇩🇪',
                'sort_order' => 2
            ],
            [
                'name' => 'کره جنوبی',
                'name_en' => 'South Korea',
                'code' => 'KOR',
                'flag' => '🇰🇷',
                'sort_order' => 3
            ],
            [
                'name' => 'ژاپن',
                'name_en' => 'Japan',
                'code' => 'JPN',
                'flag' => '🇯🇵',
                'sort_order' => 4
            ],
            [
                'name' => 'فرانسه',
                'name_en' => 'France',
                'code' => 'FRA',
                'flag' => '🇫🇷',
                'sort_order' => 5
            ],
            [
                'name' => 'سوئیس',
                'name_en' => 'Switzerland',
                'code' => 'CHE',
                'flag' => '🇨🇭',
                'sort_order' => 6
            ],
            [
                'name' => 'ایتالیا',
                'name_en' => 'Italy',
                'code' => 'ITA',
                'flag' => '🇮🇹',
                'sort_order' => 7
            ],
            [
                'name' => 'انگلستان',
                'name_en' => 'United Kingdom',
                'code' => 'GBR',
                'flag' => '🇬🇧',
                'sort_order' => 8
            ],
            [
                'name' => 'هلند',
                'name_en' => 'Netherlands',
                'code' => 'NLD',
                'flag' => '🇳🇱',
                'sort_order' => 9
            ],
            [
                'name' => 'سوئد',
                'name_en' => 'Sweden',
                'code' => 'SWE',
                'flag' => '🇸🇪',
                'sort_order' => 10
            ],
            [
                'name' => 'کانادا',
                'name_en' => 'Canada',
                'code' => 'CAN',
                'flag' => '🇨🇦',
                'sort_order' => 11
            ],
            [
                'name' => 'استرالیا',
                'name_en' => 'Australia',
                'code' => 'AUS',
                'flag' => '🇦🇺',
                'sort_order' => 12
            ],
            [
                'name' => 'چین',
                'name_en' => 'China',
                'code' => 'CHN',
                'flag' => '🇨🇳',
                'sort_order' => 13
            ],
            [
                'name' => 'هند',
                'name_en' => 'India',
                'code' => 'IND',
                'flag' => '🇮🇳',
                'sort_order' => 14
            ],
            [
                'name' => 'برزیل',
                'name_en' => 'Brazil',
                'code' => 'BRA',
                'flag' => '🇧🇷',
                'sort_order' => 15
            ]
        ];

        foreach ($countries as $countryData) {
            Country::create($countryData);
        }
    }
}
