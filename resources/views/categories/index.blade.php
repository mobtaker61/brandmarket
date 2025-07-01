@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
            <div class="p-6 text-gray-900">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 mb-2">دسته‌های محصولات</h1>
                        <p class="text-gray-600">مدیریت دسته‌بندی محصولات و زیرگروه‌ها</p>
                    </div>
                    <a href="{{ route('categories.create') }}" class="btn-primary">
                        افزودن دسته جدید
                    </a>
                </div>
            </div>
        </div>

        <!-- Categories Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" x-data="categoriesData()">
            <template x-for="category in categories" :key="category.id">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-md transition duration-150 ease-in-out">
                    <div class="p-6">
                        <!-- Category Header -->
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center">
                                <div class="text-3xl ml-3" x-text="category.icon"></div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900" x-text="category.name"></h3>
                                    <p class="text-sm text-gray-500" x-text="category.description"></p>
                                </div>
                            </div>
                            <div class="flex space-x-2 space-x-reverse">
                                <button @click="editCategory(category.id)" class="text-indigo-600 hover:text-indigo-900">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </button>
                                <button @click="deleteCategory(category.id)" class="text-red-600 hover:text-red-900">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Subcategories -->
                        <div class="mb-4">
                            <h4 class="text-sm font-medium text-gray-700 mb-2">زیرگروه‌ها:</h4>
                            <div class="flex flex-wrap gap-2">
                                <template x-for="subcategory in category.children" :key="subcategory.id">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800" x-text="subcategory.name"></span>
                                </template>
                                <span x-show="category.children.length === 0" class="text-sm text-gray-500">هیچ زیرگروهی وجود ندارد</span>
                            </div>
                        </div>

                        <!-- Stats -->
                        <div class="flex justify-between items-center text-sm text-gray-500">
                            <span class="persian-numbers" x-text="`${category.children.length} زیرگروه`"></span>
                            <span class="persian-numbers" x-text="`${category.brands_count || 0} برند`"></span>
                        </div>

                        <!-- Actions -->
                        <div class="mt-4 flex space-x-2 space-x-reverse">
                            <a :href="`/categories/${category.id}`" class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-2 px-4 rounded-lg text-center transition duration-150 ease-in-out">
                                مشاهده
                            </a>
                            <a :href="`/categories/${category.id}/edit`" class="flex-1 bg-indigo-100 hover:bg-indigo-200 text-indigo-700 font-medium py-2 px-4 rounded-lg text-center transition duration-150 ease-in-out">
                                ویرایش
                            </a>
                        </div>
                    </div>
                </div>
            </template>
        </div>

        <!-- Loading State -->
        <div x-show="loading" class="text-center py-12">
            <div class="inline-flex items-center px-4 py-2 font-semibold leading-6 text-indigo-600">
                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                در حال بارگذاری...
            </div>
        </div>

        <!-- Empty State -->
        <div x-show="!loading && categories.length === 0" class="text-center py-12">
            <div class="text-gray-500">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">هیچ دسته‌ای وجود ندارد</h3>
                <p class="mt-1 text-sm text-gray-500">شروع کنید با ایجاد اولین دسته محصولات.</p>
                <div class="mt-6">
                    <a href="{{ route('categories.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                        افزودن دسته جدید
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function categoriesData() {
    return {
        categories: [],
        loading: true,
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
                        name: 'مواد غذایی و نوشیدنی',
                        description: 'محصولات غذایی و نوشیدنی‌های مختلف',
                        icon: '🍽️',
                        color: '#FF6B6B',
                        children: [
                            { id: 1, name: 'شکلات و شیرینی' },
                            { id: 2, name: 'قهوه و نسکافه' },
                            { id: 3, name: 'نوشابه و آبمیوه' }
                        ],
                        brands_count: 25
                    },
                    {
                        id: 2,
                        name: 'لوازم آرایشی و بهداشتی',
                        description: 'محصولات آرایشی و بهداشتی',
                        icon: '💄',
                        color: '#FF69B4',
                        children: [
                            { id: 4, name: 'کرم پوست' },
                            { id: 5, name: 'ضدآفتاب' },
                            { id: 6, name: 'شامپو و نرم‌کننده' }
                        ],
                        brands_count: 18
                    }
                ];
            } finally {
                this.loading = false;
            }
        },
        editCategory(id) {
            window.location.href = `/categories/${id}/edit`;
        },
        async deleteCategory(id) {
            if (confirm('آیا مطمئن هستید که می‌خواهید این دسته را حذف کنید؟')) {
                try {
                    await axios.delete(`/categories/${id}`);
                    this.categories = this.categories.filter(cat => cat.id !== id);
                } catch (error) {
                    console.error('خطا در حذف دسته:', error);
                    alert('خطا در حذف دسته');
                }
            }
        }
    }
}
</script>
@endsection
