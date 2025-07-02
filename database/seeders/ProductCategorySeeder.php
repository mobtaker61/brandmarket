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
                'industry_keywords' => ['food', 'beverage', 'drink', 'snack', 'restaurant', 'cafe', 'bakery', 'confectionery', 'dairy', 'organic'],
                'icon' => '🍽️',
                'color' => '#FF6B6B',
                'sort_order' => 1,
                'children' => [
                    ['name' => 'شکلات و شیرینی', 'industry_keywords' => ['chocolate', 'candy', 'sweet', 'dessert'], 'icon' => '🍫', 'color' => '#FF8E8E'],
                    ['name' => 'قهوه و نسکافه', 'industry_keywords' => ['coffee', 'tea', 'hot drink', 'cafe'], 'icon' => '☕', 'color' => '#8B4513'],
                    ['name' => 'نوشابه و آبمیوه', 'industry_keywords' => ['soda', 'juice', 'soft drink', 'beverage'], 'icon' => '🥤', 'color' => '#FF6B9D'],
                    ['name' => 'پنیر و لبنیات', 'industry_keywords' => ['dairy', 'cheese', 'milk', 'yogurt'], 'icon' => '🧀', 'color' => '#FFD93D'],
                    ['name' => 'سس و ادویه', 'industry_keywords' => ['sauce', 'spice', 'condiment', 'seasoning'], 'icon' => '🌶️', 'color' => '#FF4757'],
                    ['name' => 'محصولات ارگانیک', 'industry_keywords' => ['organic', 'natural', 'healthy', 'bio'], 'icon' => '🌱', 'color' => '#2ED573']
                ]
            ],
            [
                'name' => 'لوازم آرایشی و بهداشتی',
                'description' => 'محصولات آرایشی و بهداشتی',
                'industry_keywords' => ['cosmetics', 'beauty', 'personal care', 'skincare', 'makeup', 'hygiene'],
                'icon' => '💄',
                'color' => '#FF69B4',
                'sort_order' => 2,
                'children' => [
                    ['name' => 'کرم پوست', 'industry_keywords' => ['skincare', 'cream', 'lotion', 'moisturizer'], 'icon' => '🧴', 'color' => '#FFB6C1'],
                    ['name' => 'ضدآفتاب', 'industry_keywords' => ['sunscreen', 'sun protection', 'spf'], 'icon' => '☀️', 'color' => '#FFD700'],
                    ['name' => 'شامپو و نرم‌کننده', 'industry_keywords' => ['shampoo', 'conditioner', 'hair care'], 'icon' => '🧴', 'color' => '#87CEEB'],
                    ['name' => 'عطر و ادکلن', 'industry_keywords' => ['perfume', 'fragrance', 'cologne'], 'icon' => '🌸', 'color' => '#DDA0DD'],
                    ['name' => 'ریمل و رژ', 'industry_keywords' => ['mascara', 'lipstick', 'makeup'], 'icon' => '💋', 'color' => '#FF1493'],
                    ['name' => 'محصولات بهداشت دهان', 'industry_keywords' => ['oral care', 'toothpaste', 'dental'], 'icon' => '🦷', 'color' => '#F0F8FF']
                ]
            ],
            [
                'name' => 'پوشاک و کفش',
                'description' => 'لباس و کفش برای تمام سنین',
                'industry_keywords' => ['fashion', 'clothing', 'apparel', 'shoes', 'footwear', 'textile'],
                'icon' => '👕',
                'color' => '#4169E1',
                'sort_order' => 3,
                'children' => [
                    ['name' => 'پوشاک زنانه', 'industry_keywords' => ['women fashion', 'ladies clothing', 'womenswear'], 'icon' => '👗', 'color' => '#FF69B4'],
                    ['name' => 'پوشاک مردانه', 'industry_keywords' => ['men fashion', 'menswear', 'men clothing'], 'icon' => '👔', 'color' => '#4169E1'],
                    ['name' => 'پوشاک بچه‌گانه', 'industry_keywords' => ['kids clothing', 'children fashion', 'baby clothes'], 'icon' => '👶', 'color' => '#FFB6C1'],
                    ['name' => 'کیف', 'industry_keywords' => ['bag', 'handbag', 'purse', 'accessories'], 'icon' => '👜', 'color' => '#8B4513'],
                    ['name' => 'کفش', 'industry_keywords' => ['shoes', 'footwear', 'sneakers', 'boots'], 'icon' => '👠', 'color' => '#000000'],
                    ['name' => 'پوشاک ورزشی', 'industry_keywords' => ['sportswear', 'athletic wear', 'fitness clothing'], 'icon' => '🏃', 'color' => '#32CD32'],
                    ['name' => 'لباس زیر', 'industry_keywords' => ['underwear', 'lingerie', 'intimate wear'], 'icon' => '👙', 'color' => '#FF69B4']
                ]
            ],
            [
                'name' => 'لوازم خانه و آشپزخانه',
                'description' => 'لوازم منزل و آشپزخانه',
                'industry_keywords' => ['home', 'kitchen', 'household', 'appliances', 'furniture'],
                'icon' => '🏠',
                'color' => '#FF8C00',
                'sort_order' => 4,
                'children' => [
                    ['name' => 'ظروف کریستال و چینی', 'industry_keywords' => ['crystal', 'china', 'tableware', 'dishes'], 'icon' => '🍽️', 'color' => '#F0F8FF'],
                    ['name' => 'سرویس قابلمه', 'industry_keywords' => ['cookware', 'pots', 'pans', 'kitchenware'], 'icon' => '🍳', 'color' => '#C0C0C0'],
                    ['name' => 'لوازم دکوری', 'industry_keywords' => ['decoration', 'decor', 'ornament', 'home decor'], 'icon' => '🖼️', 'color' => '#DDA0DD'],
                    ['name' => 'مایکروویو', 'industry_keywords' => ['microwave', 'appliance', 'kitchen appliance'], 'icon' => '📺', 'color' => '#696969'],
                    ['name' => 'قهوه‌ساز', 'industry_keywords' => ['coffee maker', 'espresso', 'coffee machine'], 'icon' => '☕', 'color' => '#8B4513'],
                    ['name' => 'جاروبرقی', 'industry_keywords' => ['vacuum', 'cleaner', 'cleaning'], 'icon' => '🧹', 'color' => '#808080']
                ]
            ],
            [
                'name' => 'دیجیتال و الکترونیک',
                'description' => 'محصولات دیجیتال و الکترونیکی',
                'industry_keywords' => ['electronics', 'digital', 'technology', 'gadgets', 'smartphone', 'computer'],
                'icon' => '📱',
                'color' => '#00CED1',
                'sort_order' => 5,
                'children' => [
                    ['name' => 'موبایل', 'industry_keywords' => ['mobile', 'smartphone', 'phone', 'cellphone'], 'icon' => '📱', 'color' => '#00CED1'],
                    ['name' => 'تبلت', 'industry_keywords' => ['tablet', 'ipad', 'mobile device'], 'icon' => '📱', 'color' => '#4169E1'],
                    ['name' => 'لپ‌تاپ', 'industry_keywords' => ['laptop', 'computer', 'notebook'], 'icon' => '💻', 'color' => '#000000'],
                    ['name' => 'مانیتور', 'industry_keywords' => ['monitor', 'display', 'screen'], 'icon' => '🖥️', 'color' => '#696969'],
                    ['name' => 'پاوربانک', 'industry_keywords' => ['powerbank', 'battery', 'charger'], 'icon' => '🔋', 'color' => '#FFD700'],
                    ['name' => 'هدفون', 'industry_keywords' => ['headphones', 'earphones', 'audio'], 'icon' => '🎧', 'color' => '#FF69B4'],
                    ['name' => 'اسمارت واچ', 'industry_keywords' => ['smartwatch', 'watch', 'wearable'], 'icon' => '⌚', 'color' => '#000000']
                ]
            ],
            [
                'name' => 'لوازم خودرو',
                'description' => 'لوازم و قطعات خودرو',
                'industry_keywords' => ['automotive', 'car', 'vehicle', 'auto parts', 'automotive accessories'],
                'icon' => '🚗',
                'color' => '#FF4500',
                'sort_order' => 6,
                'children' => [
                    ['name' => 'روغن موتور', 'industry_keywords' => ['motor oil', 'engine oil', 'lubricant'], 'icon' => '🛢️', 'color' => '#8B4513'],
                    ['name' => 'لاستیک', 'industry_keywords' => ['tire', 'tyre', 'wheel'], 'icon' => '🛞', 'color' => '#000000'],
                    ['name' => 'باتری', 'industry_keywords' => ['battery', 'car battery', 'automotive battery'], 'icon' => '🔋', 'color' => '#FFD700'],
                    ['name' => 'لوازم یدکی', 'industry_keywords' => ['spare parts', 'auto parts', 'car parts'], 'icon' => '🔧', 'color' => '#C0C0C0'],
                    ['name' => 'فیلتر', 'industry_keywords' => ['filter', 'air filter', 'oil filter'], 'icon' => '🧽', 'color' => '#F0F8FF'],
                    ['name' => 'باند و پخش خودرو', 'industry_keywords' => ['car audio', 'stereo', 'speaker'], 'icon' => '🎵', 'color' => '#FF69B4']
                ]
            ],
            [
                'name' => 'محصولات ورزشی و کمپینگ',
                'description' => 'لوازم ورزشی و کمپینگ',
                'industry_keywords' => ['sports', 'fitness', 'outdoor', 'camping', 'athletic', 'exercise'],
                'icon' => '⚽',
                'color' => '#32CD32',
                'sort_order' => 7,
                'children' => [
                    ['name' => 'کفش دویدن', 'industry_keywords' => ['running shoes', 'sneakers', 'athletic shoes'], 'icon' => '👟', 'color' => '#FF69B4'],
                    ['name' => 'پوشاک باشگاه', 'industry_keywords' => ['gym wear', 'workout clothes', 'fitness clothing'], 'icon' => '🏃', 'color' => '#32CD32'],
                    ['name' => 'دمبل و هالتر', 'industry_keywords' => ['dumbbells', 'weights', 'fitness equipment'], 'icon' => '🏋️', 'color' => '#C0C0C0'],
                    ['name' => 'دوچرخه', 'industry_keywords' => ['bicycle', 'bike', 'cycling'], 'icon' => '🚲', 'color' => '#FF4500'],
                    ['name' => 'چادر مسافرتی', 'industry_keywords' => ['tent', 'camping', 'outdoor'], 'icon' => '⛺', 'color' => '#8B4513'],
                    ['name' => 'کوله کمپ', 'industry_keywords' => ['backpack', 'camping gear', 'outdoor equipment'], 'icon' => '🎒', 'color' => '#4169E1']
                ]
            ],
            [
                'name' => 'کودک و نوزاد',
                'description' => 'محصولات مخصوص کودکان و نوزادان',
                'industry_keywords' => ['baby', 'child', 'infant', 'kids', 'toddler', 'nursery'],
                'icon' => '👶',
                'color' => '#FFB6C1',
                'sort_order' => 8,
                'children' => [
                    ['name' => 'شیرخشک', 'industry_keywords' => ['baby formula', 'infant formula', 'milk powder'], 'icon' => '🍼', 'color' => '#FFD700'],
                    ['name' => 'پوشک', 'industry_keywords' => ['diaper', 'nappy', 'baby care'], 'icon' => '👶', 'color' => '#FFB6C1'],
                    ['name' => 'وسایل تغذیه', 'industry_keywords' => ['baby feeding', 'bottle', 'baby food'], 'icon' => '🥄', 'color' => '#C0C0C0'],
                    ['name' => 'کالسکه', 'industry_keywords' => ['stroller', 'baby carriage', 'pram'], 'icon' => '🚼', 'color' => '#4169E1'],
                    ['name' => 'اسباب‌بازی آموزشی', 'industry_keywords' => ['educational toys', 'learning toys', 'kids toys'], 'icon' => '🧸', 'color' => '#FF69B4']
                ]
            ],
            [
                'name' => 'لوازم تحریر و اداری',
                'description' => 'لوازم تحریر و اداری',
                'industry_keywords' => ['office', 'stationery', 'school supplies', 'business supplies'],
                'icon' => '📝',
                'color' => '#4169E1',
                'sort_order' => 9,
                'children' => [
                    ['name' => 'خودکار و دفتر', 'industry_keywords' => ['pen', 'notebook', 'stationery'], 'icon' => '✏️', 'color' => '#000000'],
                    ['name' => 'پرینتر', 'industry_keywords' => ['printer', 'office equipment', 'printing'], 'icon' => '🖨️', 'color' => '#696969'],
                    ['name' => 'صندلی اداری', 'industry_keywords' => ['office chair', 'furniture', 'ergonomic'], 'icon' => '🪑', 'color' => '#8B4513'],
                    ['name' => 'تجهیزات بایگانی', 'industry_keywords' => ['filing', 'storage', 'organization'], 'icon' => '📁', 'color' => '#4169E1']
                ]
            ],
            [
                'name' => 'لوازم ساختمانی و ابزار',
                'description' => 'لوازم ساختمانی و ابزار',
                'industry_keywords' => ['construction', 'tools', 'hardware', 'building materials', 'DIY'],
                'icon' => '🔨',
                'color' => '#8B4513',
                'sort_order' => 10,
                'children' => [
                    ['name' => 'رنگ و چسب', 'industry_keywords' => ['paint', 'adhesive', 'glue', 'coating'], 'icon' => '🎨', 'color' => '#FF69B4'],
                    ['name' => 'ابزار برقی', 'industry_keywords' => ['power tools', 'electric tools', 'drill'], 'icon' => '⚡', 'color' => '#FFD700'],
                    ['name' => 'پیچ‌گوشتی و دریل', 'industry_keywords' => ['screwdriver', 'drill', 'hand tools'], 'icon' => '🔧', 'color' => '#C0C0C0'],
                    ['name' => 'شیرآلات', 'industry_keywords' => ['faucet', 'plumbing', 'water fixture'], 'icon' => '🚰', 'color' => '#87CEEB'],
                    ['name' => 'لامپ', 'industry_keywords' => ['lamp', 'lighting', 'bulb', 'light'], 'icon' => '💡', 'color' => '#FFD700']
                ]
            ],
            [
                'name' => 'محصولات دارویی و مکمل‌ها',
                'description' => 'داروها و مکمل‌های غذایی',
                'industry_keywords' => ['pharmaceutical', 'medicine', 'supplement', 'healthcare', 'vitamin'],
                'icon' => '💊',
                'color' => '#FF0000',
                'sort_order' => 11,
                'children' => [
                    ['name' => 'مولتی‌ویتامین', 'industry_keywords' => ['multivitamin', 'vitamin', 'supplement'], 'icon' => '💊', 'color' => '#FF69B4'],
                    ['name' => 'مکمل بدنسازی', 'industry_keywords' => ['protein', 'fitness supplement', 'bodybuilding'], 'icon' => '💪', 'color' => '#FFD700'],
                    ['name' => 'داروهای OTC', 'industry_keywords' => ['otc', 'over the counter', 'medicine'], 'icon' => '🏥', 'color' => '#FF0000']
                ]
            ],
            [
                'name' => 'حیوانات خانگی',
                'description' => 'محصولات مخصوص حیوانات خانگی',
                'industry_keywords' => ['pet', 'animal', 'pet care', 'veterinary', 'pet food'],
                'icon' => '🐕',
                'color' => '#8B4513',
                'sort_order' => 12,
                'children' => [
                    ['name' => 'غذای سگ و گربه', 'industry_keywords' => ['pet food', 'dog food', 'cat food'], 'icon' => '🐾', 'color' => '#8B4513'],
                    ['name' => 'اسباب‌بازی حیوانات', 'industry_keywords' => ['pet toys', 'animal toys'], 'icon' => '🎾', 'color' => '#32CD32'],
                    ['name' => 'قلاده و باکس حمل', 'industry_keywords' => ['collar', 'pet carrier', 'leash'], 'icon' => '🦮', 'color' => '#4169E1']
                ]
            ],
            [
                'name' => 'استارت آپ آنلاین',
                'description' => 'استارت آپ آنلاین',
                'industry_keywords' => ['startup', 'ecommerce','online store','E-commerce', 'online', 'digital', 'tech startup', 'platform'],
                'icon' => '🚀',
                'color' => '#FF69B4',
                'sort_order' => 13,
                'children' => [
                    ['name' => 'فروشگاه آنلاین', 'industry_keywords' => ['ecommerce','online store','Fashion Retail','online shop' ,'E-commerce','online store', 'retail', 'shopping'], 'icon' => '🛒', 'color' => '#FF69B4'],
                    ['name' => 'خدمات آنلاین', 'industry_keywords' => ['online service', 'digital service', 'platform'], 'icon' => '💻', 'color' => '#FF69B4'],
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
