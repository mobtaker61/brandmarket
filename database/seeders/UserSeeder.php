<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserType;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // پیدا کردن انواع کاربر
        $adminType = UserType::where('name', 'admin')->first();
        $staffType = UserType::where('name', 'staff')->first();
        $userType = UserType::where('name', 'user')->first();

        // کاربر مدیر
        if ($adminType) {
            User::updateOrCreate(
                ['email' => 'admin@brandmanager.com'],
                [
                    'name' => 'مدیر سیستم',
                    'email' => 'admin@brandmanager.com',
                    'password' => Hash::make('password'),
                    'user_type_id' => $adminType->id,
                ]
            );
        }

        // کاربر کارمند
        if ($staffType) {
            User::updateOrCreate(
                ['email' => 'staff@brandmanager.com'],
                [
                    'name' => 'کارمند سیستم',
                    'email' => 'staff@brandmanager.com',
                    'password' => Hash::make('password'),
                    'user_type_id' => $staffType->id,
                ]
            );
        }

        // کاربران عادی (3 کاربر)
        if ($userType) {
            $regularUsers = [
                [
                    'name' => 'احمد محمدی',
                    'email' => 'ahmad@brandmanager.com',
                ],
                [
                    'name' => 'فاطمه احمدی',
                    'email' => 'fateme@brandmanager.com',
                ],
                [
                    'name' => 'علی رضایی',
                    'email' => 'ali@brandmanager.com',
                ],
            ];

            foreach ($regularUsers as $userData) {
                User::updateOrCreate(
                    ['email' => $userData['email']],
                    [
                        'name' => $userData['name'],
                        'email' => $userData['email'],
                        'password' => Hash::make('password'),
                        'user_type_id' => $userType->id,
                    ]
                );
            }
        }

        // کاربر تست (اگر وجود نداشته باشد)
        User::updateOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'کاربر تست',
                'email' => 'test@example.com',
                'password' => Hash::make('password'),
                'user_type_id' => $adminType ? $adminType->id : null,
            ]
        );
    }
}
