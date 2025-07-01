<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProductCategory;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'مواد غذایی و نوشیدنی',
                'description' => 'محصولات غذایی و نوشیدنی‌های مختلف',
                'icon' => '🍽️',
                'color' => '#FF6B6B',
                'sort_order' => 1,
                'children' => [
                    ['name' => 'شکلات و شیرینی', 'icon' => '🍫', 'color' => '#FF8E8E'],
                    ['name' => 'قهوه و نسکافه', 'icon' => '☕', 'color' => '#8B4513'],
                    ['name' => 'نوشابه و آبمیوه', 'icon' => '🥤', 'color' => '#FF6B9D'],
                    ['name' => 'پنیر و لبنیات', 'icon' => '🧀', 'color' => '#FFD93D'],
                    ['name' => 'سس و ادویه', 'icon' => '🌶️', 'color' => '#FF4757'],
                    ['name' => 'محصولات ارگانیک', 'icon' => '🌱', 'color' => '#2ED573']
                ]
            ],
            [
                'name' => 'لوازم آرایشی و بهداشتی',
                'description' => 'محصولات آرایشی و بهداشتی',
                'icon' => '💄',
                'color' => '#FF69B4',
                'sort_order' => 2,
                'children' => [
                    ['name' => 'کرم پوست', 'icon' => '🧴', 'color' => '#FFB6C1'],
                    ['name' => 'ضدآفتاب', 'icon' => '☀️', 'color' => '#FFD700'],
                    ['name' => 'شامپو و نرم‌کننده', 'icon' => '🧴', 'color' => '#87CEEB'],
                    ['name' => 'عطر و ادکلن', 'icon' => '🌸', 'color' => '#DDA0DD'],
                    ['name' => 'ریمل و رژ', 'icon' => '💋', 'color' => '#FF1493'],
                    ['name' => 'محصولات بهداشت دهان', 'icon' => '🦷', 'color' => '#F0F8FF']
                ]
            ],
            [
                'name' => 'پوشاک و کفش',
                'description' => 'لباس و کفش برای تمام سنین',
                'icon' => '👕',
                'color' => '#4169E1',
                'sort_order' => 3,
                'children' => [
                    ['name' => 'پوشاک زنانه', 'icon' => '👗', 'color' => '#FF69B4'],
                    ['name' => 'پوشاک مردانه', 'icon' => '👔', 'color' => '#4169E1'],
                    ['name' => 'پوشاک بچه‌گانه', 'icon' => '👶', 'color' => '#FFB6C1'],
                    ['name' => 'کیف', 'icon' => '👜', 'color' => '#8B4513'],
                    ['name' => 'کفش', 'icon' => '👠', 'color' => '#000000'],
                    ['name' => 'پوشاک ورزشی', 'icon' => '🏃', 'color' => '#32CD32'],
                    ['name' => 'لباس زیر', 'icon' => '👙', 'color' => '#FF69B4']
                ]
            ],
            [
                'name' => 'لوازم خانه و آشپزخانه',
                'description' => 'لوازم منزل و آشپزخانه',
                'icon' => '🏠',
                'color' => '#FF8C00',
                'sort_order' => 4,
                'children' => [
                    ['name' => 'ظروف کریستال و چینی', 'icon' => '🍽️', 'color' => '#F0F8FF'],
                    ['name' => 'سرویس قابلمه', 'icon' => '🍳', 'color' => '#C0C0C0'],
                    ['name' => 'لوازم دکوری', 'icon' => '🖼️', 'color' => '#DDA0DD'],
                    ['name' => 'مایکروویو', 'icon' => '📺', 'color' => '#696969'],
                    ['name' => 'قهوه‌ساز', 'icon' => '☕', 'color' => '#8B4513'],
                    ['name' => 'جاروبرقی', 'icon' => '🧹', 'color' => '#808080']
                ]
            ],
            [
                'name' => 'دیجیتال و الکترونیک',
                'description' => 'محصولات دیجیتال و الکترونیکی',
                'icon' => '📱',
                'color' => '#00CED1',
                'sort_order' => 5,
                'children' => [
                    ['name' => 'موبایل', 'icon' => '📱', 'color' => '#00CED1'],
                    ['name' => 'تبلت', 'icon' => '📱', 'color' => '#4169E1'],
                    ['name' => 'لپ‌تاپ', 'icon' => '💻', 'color' => '#000000'],
                    ['name' => 'مانیتور', 'icon' => '🖥️', 'color' => '#696969'],
                    ['name' => 'پاوربانک', 'icon' => '🔋', 'color' => '#FFD700'],
                    ['name' => 'هدفون', 'icon' => '🎧', 'color' => '#FF69B4'],
                    ['name' => 'اسمارت واچ', 'icon' => '⌚', 'color' => '#000000']
                ]
            ],
            [
                'name' => 'لوازم خودرو',
                'description' => 'لوازم و قطعات خودرو',
                'icon' => '🚗',
                'color' => '#FF4500',
                'sort_order' => 6,
                'children' => [
                    ['name' => 'روغن موتور', 'icon' => '🛢️', 'color' => '#8B4513'],
                    ['name' => 'لاستیک', 'icon' => '🛞', 'color' => '#000000'],
                    ['name' => 'باتری', 'icon' => '🔋', 'color' => '#FFD700'],
                    ['name' => 'لوازم یدکی', 'icon' => '🔧', 'color' => '#C0C0C0'],
                    ['name' => 'فیلتر', 'icon' => '🧽', 'color' => '#F0F8FF'],
                    ['name' => 'باند و پخش خودرو', 'icon' => '🎵', 'color' => '#FF69B4']
                ]
            ],
            [
                'name' => 'محصولات ورزشی و کمپینگ',
                'description' => 'لوازم ورزشی و کمپینگ',
                'icon' => '⚽',
                'color' => '#32CD32',
                'sort_order' => 7,
                'children' => [
                    ['name' => 'کفش دویدن', 'icon' => '👟', 'color' => '#FF69B4'],
                    ['name' => 'پوشاک باشگاه', 'icon' => '🏃', 'color' => '#32CD32'],
                    ['name' => 'دمبل و هالتر', 'icon' => '🏋️', 'color' => '#C0C0C0'],
                    ['name' => 'دوچرخه', 'icon' => '🚲', 'color' => '#FF4500'],
                    ['name' => 'چادر مسافرتی', 'icon' => '⛺', 'color' => '#8B4513'],
                    ['name' => 'کوله کمپ', 'icon' => '🎒', 'color' => '#4169E1']
                ]
            ],
            [
                'name' => 'کودک و نوزاد',
                'description' => 'محصولات مخصوص کودکان و نوزادان',
                'icon' => '👶',
                'color' => '#FFB6C1',
                'sort_order' => 8,
                'children' => [
                    ['name' => 'شیرخشک', 'icon' => '🍼', 'color' => '#FFD700'],
                    ['name' => 'پوشک', 'icon' => '👶', 'color' => '#FFB6C1'],
                    ['name' => 'وسایل تغذیه', 'icon' => '🥄', 'color' => '#C0C0C0'],
                    ['name' => 'کالسکه', 'icon' => '🚼', 'color' => '#4169E1'],
                    ['name' => 'اسباب‌بازی آموزشی', 'icon' => '🧸', 'color' => '#FF69B4']
                ]
            ],
            [
                'name' => 'لوازم تحریر و اداری',
                'description' => 'لوازم تحریر و اداری',
                'icon' => '📝',
                'color' => '#4169E1',
                'sort_order' => 9,
                'children' => [
                    ['name' => 'خودکار و دفتر', 'icon' => '✏️', 'color' => '#000000'],
                    ['name' => 'پرینتر', 'icon' => '🖨️', 'color' => '#696969'],
                    ['name' => 'صندلی اداری', 'icon' => '🪑', 'color' => '#8B4513'],
                    ['name' => 'تجهیزات بایگانی', 'icon' => '📁', 'color' => '#4169E1']
                ]
            ],
            [
                'name' => 'لوازم ساختمانی و ابزار',
                'description' => 'لوازم ساختمانی و ابزار',
                'icon' => '🔨',
                'color' => '#8B4513',
                'sort_order' => 10,
                'children' => [
                    ['name' => 'رنگ و چسب', 'icon' => '🎨', 'color' => '#FF69B4'],
                    ['name' => 'ابزار برقی', 'icon' => '⚡', 'color' => '#FFD700'],
                    ['name' => 'پیچ‌گوشتی و دریل', 'icon' => '🔧', 'color' => '#C0C0C0'],
                    ['name' => 'شیرآلات', 'icon' => '🚰', 'color' => '#87CEEB'],
                    ['name' => 'لامپ', 'icon' => '💡', 'color' => '#FFD700']
                ]
            ],
            [
                'name' => 'محصولات دارویی و مکمل‌ها',
                'description' => 'داروها و مکمل‌های غذایی',
                'icon' => '💊',
                'color' => '#FF0000',
                'sort_order' => 11,
                'children' => [
                    ['name' => 'مولتی‌ویتامین', 'icon' => '💊', 'color' => '#FF69B4'],
                    ['name' => 'مکمل بدنسازی', 'icon' => '💪', 'color' => '#FFD700'],
                    ['name' => 'داروهای OTC', 'icon' => '🏥', 'color' => '#FF0000']
                ]
            ],
            [
                'name' => 'حیوانات خانگی',
                'description' => 'محصولات مخصوص حیوانات خانگی',
                'icon' => '🐕',
                'color' => '#8B4513',
                'sort_order' => 12,
                'children' => [
                    ['name' => 'غذای سگ و گربه', 'icon' => '🐾', 'color' => '#8B4513'],
                    ['name' => 'اسباب‌بازی حیوانات', 'icon' => '🎾', 'color' => '#32CD32'],
                    ['name' => 'قلاده و باکس حمل', 'icon' => '🦮', 'color' => '#4169E1']
                ]
            ]
        ];

        foreach ($categories as $categoryData) {
            $children = $categoryData['children'] ?? [];
            unset($categoryData['children']);

            $category = ProductCategory::create($categoryData);

            foreach ($children as $childData) {
                $childData['parent_id'] = $category->id;
                $childData['sort_order'] = $childData['sort_order'] ?? 0;
                ProductCategory::create($childData);
            }
        }
    }
}
