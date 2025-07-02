@extends('layouts.app')

@section('content')
<div class="py-4">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8" x-data="statsData()">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-8 w-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <div class="mr-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">کل برندها</dt>
                                <dd class="text-lg font-medium text-gray-900 persian-numbers" x-text="stats.totalBrands"></dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-8 w-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="mr-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">برندهای فعال</dt>
                                <dd class="text-lg font-medium text-gray-900 persian-numbers" x-text="stats.activeBrands"></dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-8 w-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                            </svg>
                        </div>
                        <div class="mr-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">رشد ماهانه</dt>
                                <dd class="text-lg font-medium text-gray-900 persian-numbers" x-text="stats.monthlyGrowth + '%'"></dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Categories Section -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8" x-data="categoriesData()">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-semibold text-gray-900">دسته‌های محصولات</h2>
                    <a href="{{ route('categories.index') }}" class="text-indigo-600 hover:text-indigo-900 text-sm font-medium">
                        ← مشاهده همه
                    </a>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                    <template x-for="category in categories.slice(0, 6)" :key="category.id">
                        <a :href="`/categories/${category.id}`" class="group">
                            <div class="text-center p-4 rounded-lg border border-gray-200 hover:border-indigo-300 hover:bg-indigo-50 transition duration-150 ease-in-out">
                                <div class="text-3xl mb-2" x-text="category.icon"></div>
                                <h3 class="text-sm font-medium text-gray-900 group-hover:text-indigo-900" x-text="category.name"></h3>
                                <p class="text-xs text-gray-500 mt-1 persian-numbers" x-text="`${category.children.length} زیرگروه`"></p>
                            </div>
                        </a>
                    </template>
                </div>
            </div>
        </div>

        <!-- Recent Brands -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg w-1/2 mx-auto" x-data="recentBrands()">
            <div class="p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">برندهای اخیر</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 table">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">تصویر</th>
                                <th class="px-4 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">نام برند</th>
                                <th class="px-4 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">دسته‌بندی</th>
                                <th class="px-4 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">سطح برند</th>
                                <th class="px-4 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">مالک</th>
                                <th class="px-4 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">وضعیت</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <template x-if="brands.length === 0">
                                <tr>
                                    <td colspan="6" class="px-6 py-8 text-center">
                                        <div class="text-gray-500">
                                            <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                            </svg>
                                            <p class="text-lg font-medium">هیچ برندی یافت نشد</p>
                                            <p class="text-sm">برای شروع، برند جدیدی اضافه کنید</p>
                                            <a href="{{ route('brands.create') }}" class="mt-4 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                                                افزودن برند جدید
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            </template>
                            <template x-for="brand in brands" :key="brand.id">
                                <tr>
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        <img class="h-10 w-10 rounded-full object-cover mx-auto" :src="brand.logo || '/images/default-brand.svg'" :alt="brand.name">
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">
                                        <span class="flex items-start justify-start">
                                            <span x-text="brand.country_flag"></span>
                                            <a :href="`/brands/${brand.id}`" class="mr-1 text-blue-600 hover:text-blue-900 hover:underline" x-text="brand.name"></a>
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900 text-center" x-text="brand.category_name"></td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900 text-center">
                                        <i :class="brand.level_icon" :style="`color: ${brand.level_color}`" class="ml-1"></i>
                                        <span x-text="brand.level_name"></span>
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900 text-center" x-text="brand.owner_name"></td>
                                    <td class="px-4 py-3 whitespace-nowrap text-center">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full"
                                              :class="{
                                                'bg-blue-100 text-blue-800': brand.brand_status === 'listed',
                                                'bg-yellow-100 text-yellow-800': brand.brand_status === 'started',
                                                'bg-orange-100 text-orange-800': brand.brand_status === 'waiting',
                                                'bg-red-100 text-red-800': brand.brand_status === 'rejected',
                                                'bg-green-100 text-green-800': brand.brand_status === 'registered',
                                                'bg-gray-100 text-gray-800': !['listed','started','waiting','rejected','registered'].includes(brand.brand_status)
                                              }"
                                              x-text="{
                                                'listed': 'لیست شده',
                                                'started': 'شروع شده',
                                                'waiting': 'در انتظار',
                                                'rejected': 'رد شده',
                                                'registered': 'ثبت رسمی'
                                              }[brand.brand_status] || 'نامشخص'"></span>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function statsData() {
    return {
        stats: {
            totalBrands: 0,
            activeBrands: 0,
            monthlyGrowth: 0
        },
        init() {
            this.loadStats();
        },
        async loadStats() {
            try {
                const response = await axios.get('/api/stats');
                this.stats = response.data;
            } catch (error) {
                console.error('خطا در بارگذاری آمار:', error);
                // داده‌های نمونه برای نمایش
                this.stats = {
                    totalBrands: 150,
                    activeBrands: 120,
                    monthlyGrowth: 12.5
                };
            }
        }
    }
}

function categoriesData() {
    return {
        categories: [],
        init() {
            this.loadCategories();
        },
        async loadCategories() {
            try {
                const response = await axios.get('/api/categories');
                this.categories = response.data;
            } catch (error) {
                console.error('خطا در بارگذاری دسته‌ها:', error);
                // داده‌های نمونه برای نمایش
                this.categories = [
                    {
                        id: 1,
                        name: 'مواد غذایی',
                        icon: '🍽️',
                        children: [{}, {}, {}]
                    },
                    {
                        id: 2,
                        name: 'لوازم آرایشی',
                        icon: '💄',
                        children: [{}, {}]
                    },
                    {
                        id: 3,
                        name: 'پوشاک',
                        icon: '👕',
                        children: [{}, {}, {}, {}]
                    },
                    {
                        id: 4,
                        name: 'دیجیتال',
                        icon: '📱',
                        children: [{}, {}, {}]
                    },
                    {
                        id: 5,
                        name: 'خودرو',
                        icon: '🚗',
                        children: [{}, {}]
                    },
                    {
                        id: 6,
                        name: 'ورزشی',
                        icon: '⚽',
                        children: [{}, {}, {}]
                    }
                ];
            }
        }
    }
}

function recentBrands() {
    return {
        brands: [],
        init() {
            this.loadRecentBrands();
        },
        async loadRecentBrands() {
            try {
                const response = await axios.get('/api/brands/recent');
                this.brands = response.data;
            } catch (error) {
                console.error('خطا در بارگذاری برندهای اخیر:', error);
                // داده‌های نمونه برای نمایش
                this.brands = [
                    {
                        id: 1,
                        name: 'Apple',
                        description: 'شرکت اپل آمریکا',
                        country_name: 'آمریکا',
                        category_name: 'تکنولوژی',
                        level_name: 'پرمیوم',
                        level_icon: 'fas fa-crown',
                        level_color: '#FFD700',
                        owner_name: 'مدیر سیستم',
                        is_active: true,
                        brand_status: 'listed',
                        logo: 'https://via.placeholder.com/40'
                    },
                    {
                        id: 2,
                        name: 'Samsung',
                        description: 'سامسونگ الکترونیکس',
                        country_name: 'کره جنوبی',
                        category_name: 'تکنولوژی',
                        level_name: 'طلایی',
                        level_icon: 'fas fa-medal',
                        level_color: '#FFA500',
                        owner_name: 'کاربر عادی',
                        is_active: true,
                        brand_status: 'started',
                        logo: 'https://via.placeholder.com/40'
                    },
                    {
                        id: 3,
                        name: 'Nike',
                        description: 'نایک اینکورپوریتد',
                        country_name: 'آمریکا',
                        category_name: 'ورزشی',
                        level_name: 'نقره‌ای',
                        level_icon: 'fas fa-award',
                        level_color: '#C0C0C0',
                        owner_name: 'کارمند',
                        is_active: false,
                        brand_status: 'registered',
                        logo: 'https://via.placeholder.com/40'
                    }
                ];
            }
        },
        addNewBrand() {
            window.location.href = '/brands/create';
        },
        importBrands() {
            // منطق وارد کردن برندها
            alert('ویژگی وارد کردن برندها به زودی اضافه خواهد شد');
        },
        generateReport() {
            // منطق تولید گزارش
            alert('ویژگی تولید گزارش به زودی اضافه خواهد شد');
        },
        exportData() {
            // منطق خروجی داده
            alert('ویژگی خروجی داده به زودی اضافه خواهد شد');
        },
        editBrand(id) {
            window.location.href = `/brands/${id}/edit`;
        },
        viewBrand(id) {
            window.location.href = `/brands/${id}`;
        }
    }
}
</script>
@endsection
