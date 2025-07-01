<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Brand;
use App\Models\ProductCategory;
use App\Models\Country;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            [
                'name' => 'Nike',
                'company_name' => 'Nike, Inc.',
                'country_name' => 'آمریکا',
                'description' => 'شرکت تولیدکننده لوازم ورزشی و کفش',
                'website' => 'https://www.nike.com',
                'instagram' => 'nike',
                'telegram' => 'nike_official',
                'linkedin' => 'nike',
                'brand_status' => 'active',
                'iran_market_presence' => 'unofficial',
                'is_active' => true,
                'notes' => 'محصولات Nike در ایران موجود است اما نمایندگی رسمی ندارد',
                'categories' => ['پوشاک ورزشی', 'کفش دویدن']
            ],
            [
                'name' => 'Adidas',
                'company_name' => 'Adidas AG',
                'country_name' => 'آلمان',
                'description' => 'شرکت تولیدکننده لوازم ورزشی و پوشاک',
                'website' => 'https://www.adidas.com',
                'instagram' => 'adidas',
                'telegram' => 'adidas_official',
                'linkedin' => 'adidas',
                'brand_status' => 'active',
                'iran_market_presence' => 'unofficial',
                'is_active' => true,
                'notes' => 'محصولات Adidas در بازار ایران موجود است',
                'categories' => ['پوشاک ورزشی', 'کفش دویدن']
            ],
            [
                'name' => 'Apple',
                'company_name' => 'Apple Inc.',
                'country_name' => 'آمریکا',
                'description' => 'شرکت تولیدکننده محصولات الکترونیکی و نرم‌افزار',
                'website' => 'https://www.apple.com',
                'instagram' => 'apple',
                'telegram' => 'apple_official',
                'linkedin' => 'apple',
                'brand_status' => 'active',
                'iran_market_presence' => 'unofficial',
                'is_active' => true,
                'notes' => 'محصولات Apple در ایران موجود است اما نمایندگی رسمی ندارد',
                'categories' => ['موبایل', 'لپ‌تاپ', 'تبلت']
            ],
            [
                'name' => 'Samsung',
                'company_name' => 'Samsung Electronics',
                'country_name' => 'کره جنوبی',
                'description' => 'شرکت تولیدکننده محصولات الکترونیکی',
                'website' => 'https://www.samsung.com',
                'instagram' => 'samsung',
                'telegram' => 'samsung_official',
                'linkedin' => 'samsung',
                'brand_status' => 'active',
                'iran_market_presence' => 'unofficial',
                'is_active' => true,
                'notes' => 'محصولات Samsung در ایران موجود است',
                'categories' => ['موبایل', 'لپ‌تاپ', 'مانیتور']
            ],
            [
                'name' => 'Coca-Cola',
                'company_name' => 'The Coca-Cola Company',
                'country_name' => 'آمریکا',
                'description' => 'شرکت تولیدکننده نوشیدنی‌های گازدار',
                'website' => 'https://www.coca-cola.com',
                'instagram' => 'cocacola',
                'telegram' => 'cocacola_official',
                'linkedin' => 'coca-cola-company',
                'brand_status' => 'active',
                'iran_market_presence' => 'absent',
                'is_active' => true,
                'notes' => 'محصولات Coca-Cola در ایران موجود نیست',
                'categories' => ['نوشابه و آبمیوه']
            ],
            [
                'name' => 'Pepsi',
                'company_name' => 'PepsiCo, Inc.',
                'country_name' => 'آمریکا',
                'description' => 'شرکت تولیدکننده نوشیدنی‌ها و تنقلات',
                'website' => 'https://www.pepsi.com',
                'instagram' => 'pepsi',
                'telegram' => 'pepsi_official',
                'linkedin' => 'pepsico',
                'brand_status' => 'active',
                'iran_market_presence' => 'unofficial',
                'is_active' => true,
                'notes' => 'محصولات Pepsi در ایران موجود است',
                'categories' => ['نوشابه و آبمیوه']
            ],
            [
                'name' => 'McDonald\'s',
                'company_name' => 'McDonald\'s Corporation',
                'country_name' => 'آمریکا',
                'description' => 'شرکت رستوران‌های فست فود',
                'website' => 'https://www.mcdonalds.com',
                'instagram' => 'mcdonalds',
                'telegram' => 'mcdonalds_official',
                'linkedin' => 'mcdonalds-corporation',
                'brand_status' => 'active',
                'iran_market_presence' => 'absent',
                'is_active' => true,
                'notes' => 'McDonald\'s در ایران شعبه ندارد',
                'categories' => ['مواد غذایی و نوشیدنی']
            ],
            [
                'name' => 'KFC',
                'company_name' => 'Yum! Brands',
                'country_name' => 'آمریکا',
                'description' => 'رستوران زنجیره‌ای فست فود',
                'website' => 'https://www.kfc.com',
                'instagram' => 'kfc',
                'telegram' => 'kfc_official',
                'linkedin' => 'kfc',
                'brand_status' => 'active',
                'iran_market_presence' => 'absent',
                'is_active' => true,
                'notes' => 'KFC در ایران شعبه ندارد',
                'categories' => ['مواد غذایی و نوشیدنی']
            ],
            [
                'name' => 'Toyota',
                'company_name' => 'Toyota Motor Corporation',
                'country_name' => 'ژاپن',
                'description' => 'شرکت تولیدکننده خودرو',
                'website' => 'https://www.toyota.com',
                'instagram' => 'toyota',
                'telegram' => 'toyota_official',
                'linkedin' => 'toyota-motor-corporation',
                'brand_status' => 'active',
                'iran_market_presence' => 'unofficial',
                'is_active' => true,
                'notes' => 'خودروهای Toyota در ایران موجود است',
                'categories' => ['لوازم یدکی']
            ],
            [
                'name' => 'Honda',
                'company_name' => 'Honda Motor Co., Ltd.',
                'country_name' => 'ژاپن',
                'description' => 'شرکت تولیدکننده خودرو و موتورسیکلت',
                'website' => 'https://www.honda.com',
                'instagram' => 'honda',
                'telegram' => 'honda_official',
                'linkedin' => 'honda-motor-co-ltd',
                'brand_status' => 'active',
                'iran_market_presence' => 'unofficial',
                'is_active' => true,
                'notes' => 'محصولات Honda در ایران موجود است',
                'categories' => ['لوازم یدکی']
            ],
            [
                'name' => 'L\'Oréal',
                'company_name' => 'L\'Oréal S.A.',
                'country_name' => 'فرانسه',
                'description' => 'شرکت تولیدکننده لوازم آرایشی و بهداشتی',
                'website' => 'https://www.loreal.com',
                'instagram' => 'lorealparis',
                'telegram' => 'loreal_official',
                'linkedin' => 'loreal',
                'brand_status' => 'active',
                'iran_market_presence' => 'unofficial',
                'is_active' => true,
                'notes' => 'محصولات L\'Oréal در ایران موجود است',
                'categories' => ['کرم پوست', 'شامپو و نرم‌کننده', 'عطر و ادکلن']
            ],
            [
                'name' => 'Nestlé',
                'company_name' => 'Nestlé S.A.',
                'country_name' => 'سوئیس',
                'description' => 'شرکت تولیدکننده مواد غذایی و نوشیدنی',
                'website' => 'https://www.nestle.com',
                'instagram' => 'nestle',
                'telegram' => 'nestle_official',
                'linkedin' => 'nestle',
                'brand_status' => 'active',
                'iran_market_presence' => 'unofficial',
                'is_active' => true,
                'notes' => 'محصولات Nestlé در ایران موجود است',
                'categories' => ['شکلات و شیرینی', 'شیرخشک', 'قهوه و نسکافه']
            ]
        ];

        foreach ($brands as $brandData) {
            $categories = $brandData['categories'];
            $countryName = $brandData['country_name'];
            unset($brandData['categories'], $brandData['country_name']);

            // پیدا کردن کشور بر اساس نام
            $country = Country::where('name', $countryName)->first();
            if ($country) {
                $brandData['country_id'] = $country->id;
            }

            $brand = Brand::create($brandData);

            // اتصال برند به دسته‌های مربوطه
            foreach ($categories as $categoryName) {
                $category = ProductCategory::where('name', $categoryName)->first();
                if ($category) {
                    $brand->categories()->attach($category->id, [
                        'is_primary' => $brand->categories()->count() === 0 // اولین دسته به عنوان اصلی
                    ]);
                }
            }
        }
    }
}
