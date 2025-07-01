<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BrandLevel;

class BrandLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brandLevels = [
            [
                'name' => 'premium',
                'display_name' => 'پرمیوم',
                'description' => 'برندهای لوکس و با ارزش بالا که در سطح جهانی شناخته شده هستند',
                'color' => '#DC2626', // قرمز
                'icon' => 'fas fa-crown',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'gold',
                'display_name' => 'طلایی',
                'description' => 'برندهای با کیفیت بالا و ارزش متوسط تا بالا',
                'color' => '#F59E0B', // طلایی
                'icon' => 'fas fa-medal',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'silver',
                'display_name' => 'نقره‌ای',
                'description' => 'برندهای با کیفیت خوب و ارزش متوسط',
                'color' => '#6B7280', // نقره‌ای
                'icon' => 'fas fa-award',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'bronze',
                'display_name' => 'برنزی',
                'description' => 'برندهای با کیفیت قابل قبول و ارزش پایین تا متوسط',
                'color' => '#CD7F32', // برنزی
                'icon' => 'fas fa-star',
                'sort_order' => 4,
                'is_active' => true,
            ],
        ];

        foreach ($brandLevels as $brandLevelData) {
            BrandLevel::create($brandLevelData);
        }
    }
}
