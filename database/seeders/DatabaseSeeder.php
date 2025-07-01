<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // ایجاد کاربر تست فقط اگر وجود نداشته باشد
        if (!User::where('email', 'test@example.com')->exists()) {
            User::factory()->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
            ]);
        }

        // اجرای Seeder ها به ترتیب
        $this->call([
            UserTypeSeeder::class,
            BrandLevelSeeder::class,
            UserSeeder::class,
            CountrySeeder::class,
            ProductCategorySeeder::class,
            BrandSeeder::class,
        ]);
    }
}
