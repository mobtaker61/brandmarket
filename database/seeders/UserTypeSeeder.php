<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserType;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userTypes = [
            [
                'name' => 'admin',
                'display_name' => 'مدیر سیستم',
                'description' => 'دسترسی کامل به تمام بخش‌های سیستم',
                'color' => '#DC2626', // قرمز
                'icon' => 'fas fa-crown',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'staff',
                'display_name' => 'کارمند',
                'description' => 'دسترسی محدود به بخش‌های خاص سیستم',
                'color' => '#2563EB', // آبی
                'icon' => 'fas fa-user-tie',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'user',
                'display_name' => 'کاربر عادی',
                'description' => 'دسترسی عمومی به سیستم',
                'color' => '#059669', // سبز
                'icon' => 'fas fa-user',
                'sort_order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($userTypes as $userTypeData) {
            UserType::create($userTypeData);
        }
    }
}
