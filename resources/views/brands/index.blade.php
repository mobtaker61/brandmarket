@extends("layouts.app")

@section('title', 'لیست برندها')

@php
    // Helper function to build URL without specific parameter
    function buildUrlWithout($param) {
        $query = request()->query();
        unset($query[$param]);
        return request()->url() . (count($query) > 0 ? '?' . http_build_query($query) : '');
    }

    // Helper function to get single value from request
    function getRequestValue($key, $default = null) {
        $value = request($key, $default);
        return is_array($value) ? $value[0] : $value;
    }
@endphp

@section('content')
<div class="container mx-auto px-4 py-8" x-data="brandsIndex()">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">لیست برندها</h1>
                <p class="text-gray-600">مدیریت برندهای بین‌المللی و وضعیت حضور آنها در بازار ایران</p>
            </div>
            <div class="flex space-x-2 space-x-reverse">
                <a href="{{ route('brands.export', request()->query()) }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-3 rounded-lg font-medium transition-colors">
                    <i class="fas fa-download ml-2"></i>
                    Export CSV
                </a>
                <a href="{{ route('brands.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium transition-colors">
                    <i class="fas fa-plus ml-2"></i>
                    افزودن برند جدید
                </a>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
        <form method="GET" action="{{ route('brands.index') }}" x-data="{ showAdvanced: false }">
            <!-- Basic Filters -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
                <!-- Search -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">جستجو</label>
                    <input
                        type="text"
                        name="search"
                        value="{{ getRequestValue('search') }}"
                        placeholder="جستجو در نام برند، شرکت یا کشور..."
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                </div>

                <!-- Country Filter -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">کشور</label>
                    <select
                        name="country"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                        <option value="">همه کشورها</option>
                        @foreach($countries as $country)
                            @php $currentCountry = getRequestValue('country') == $country->id; @endphp
                            <option value="{{ $country->id }}" {{ $currentCountry ? 'selected' : '' }}>
                                {{ $country->flag }} {{ $country->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Category Filter -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">دسته محصول</label>
                    <select
                        name="category"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                        <option value="">همه دسته‌ها</option>
                        @foreach($categories as $category)
                            @php $currentCategory = getRequestValue('category') == $category->id; @endphp
                            <option value="{{ $category->id }}" {{ $currentCategory ? 'selected' : '' }}>
                                {{ $category->icon ?? '' }} {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Iran Presence Filter -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">حضور در ایران</label>
                    <select
                        name="iran_presence"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                        <option value="">همه</option>
                        @php $currentPresence = getRequestValue('iran_presence'); @endphp
                        <option value="official" {{ $currentPresence == 'official' ? 'selected' : '' }}>رسمی</option>
                        <option value="unofficial" {{ $currentPresence == 'unofficial' ? 'selected' : '' }}>غیررسمی</option>
                        <option value="absent" {{ $currentPresence == 'absent' ? 'selected' : '' }}>غایب</option>
                    </select>
                </div>
            </div>

            <!-- Advanced Filters Toggle -->
            <div class="mb-4">
                <button
                    type="button"
                    @click="showAdvanced = !showAdvanced"
                    class="text-blue-600 hover:text-blue-800 text-sm font-medium flex items-center"
                >
                    <i class="fas fa-filter ml-1"></i>
                    فیلترهای پیشرفته
                    <i class="fas fa-chevron-down ml-1" :class="{ 'rotate-180': showAdvanced }"></i>
                </button>
            </div>

            <!-- Advanced Filters -->
            <div x-show="showAdvanced" x-transition class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                <!-- Brand Status Filter -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">وضعیت برند</label>
                    <select
                        name="brand_status"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                        <option value="">همه</option>
                        @php $currentBrandStatus = getRequestValue('brand_status'); @endphp
                        <option value="active" {{ $currentBrandStatus == 'active' ? 'selected' : '' }}>فعال</option>
                        <option value="inactive" {{ $currentBrandStatus == 'inactive' ? 'selected' : '' }}>غیرفعال</option>
                        <option value="pending" {{ $currentBrandStatus == 'pending' ? 'selected' : '' }}>در انتظار</option>
                    </select>
                </div>

                <!-- Active Status Filter -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">وضعیت فعال</label>
                    <select
                        name="is_active"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                        <option value="">همه</option>
                        @php $currentIsActive = getRequestValue('is_active'); @endphp
                        <option value="1" {{ $currentIsActive == '1' ? 'selected' : '' }}>فعال</option>
                        <option value="0" {{ $currentIsActive == '0' ? 'selected' : '' }}>غیرفعال</option>
                    </select>
                </div>

                <!-- Sort Order -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">مرتب‌سازی</label>
                    <select
                        name="sort"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                        @php $currentSort = getRequestValue('sort', 'latest'); @endphp
                        <option value="latest" {{ $currentSort == 'latest' ? 'selected' : '' }}>جدیدترین</option>
                        <option value="oldest" {{ $currentSort == 'oldest' ? 'selected' : '' }}>قدیمی‌ترین</option>
                        <option value="name_asc" {{ $currentSort == 'name_asc' ? 'selected' : '' }}>نام (صعودی)</option>
                        <option value="name_desc" {{ $currentSort == 'name_desc' ? 'selected' : '' }}>نام (نزولی)</option>
                    </select>
                </div>

                <!-- Per Page -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">تعداد در صفحه</label>
                    <select
                        name="per_page"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                        @php $currentPerPage = getRequestValue('per_page', '20'); @endphp
                        <option value="10" {{ $currentPerPage == '10' ? 'selected' : '' }}>10</option>
                        <option value="20" {{ $currentPerPage == '20' ? 'selected' : '' }}>20</option>
                        <option value="50" {{ $currentPerPage == '50' ? 'selected' : '' }}>50</option>
                        <option value="100" {{ $currentPerPage == '100' ? 'selected' : '' }}>100</option>
                    </select>
                </div>
            </div>

            <!-- Filter Actions -->
            <div class="flex justify-between items-center">
                <div class="flex space-x-2 space-x-reverse">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                        <i class="fas fa-search ml-2"></i>
                        اعمال فیلتر
                    </button>
                    <a href="{{ route('brands.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                        <i class="fas fa-times ml-2"></i>
                        پاک کردن
                    </a>
                </div>

                @if(getRequestValue('search') || getRequestValue('country') || getRequestValue('category') || getRequestValue('iran_presence') || getRequestValue('brand_status') || getRequestValue('is_active') || getRequestValue('sort'))
                    <div class="text-sm text-gray-600">
                        {{ $brands->total() }} نتیجه یافت شد
                    </div>
                @endif
            </div>
        </form>
    </div>

    <!-- Quick Filters -->
    <div class="bg-gray-50 rounded-lg p-4 mb-6">
        <h3 class="text-sm font-medium text-gray-700 mb-3">فیلترهای سریع:</h3>
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('brands.index', ['iran_presence' => 'official']) }}"
               class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 hover:bg-green-200">
                <i class="fas fa-check ml-1"></i>
                رسمی در ایران
            </a>
            <a href="{{ route('brands.index', ['iran_presence' => 'unofficial']) }}"
               class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 hover:bg-yellow-200">
                <i class="fas fa-exclamation-triangle ml-1"></i>
                غیررسمی در ایران
            </a>
            <a href="{{ route('brands.index', ['iran_presence' => 'absent']) }}"
               class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800 hover:bg-red-200">
                <i class="fas fa-times ml-1"></i>
                غایب از ایران
            </a>
            <a href="{{ route('brands.index', ['brand_status' => 'active']) }}"
               class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 hover:bg-blue-200">
                <i class="fas fa-check-circle ml-1"></i>
                برندهای فعال
            </a>
            <a href="{{ route('brands.index', ['is_active' => '1']) }}"
               class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800 hover:bg-purple-200">
                <i class="fas fa-star ml-1"></i>
                فعال در سیستم
            </a>
        </div>
    </div>

    <!-- Active Filters Display -->
    @if(getRequestValue('search') || getRequestValue('country') || getRequestValue('category') || getRequestValue('iran_presence') || getRequestValue('brand_status') || getRequestValue('is_active') || getRequestValue('sort'))
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <i class="fas fa-filter text-blue-600 ml-2"></i>
                    <span class="text-sm font-medium text-blue-900">فیلترهای فعال:</span>
                </div>
                <a href="{{ route('brands.index') }}" class="text-blue-600 hover:text-blue-800 text-sm">
                    <i class="fas fa-times ml-1"></i>
                    پاک کردن همه
                </a>
            </div>
            <div class="flex flex-wrap gap-2 mt-2">
                @if(getRequestValue('search'))
                    @php $currentSearch = getRequestValue('search'); @endphp
                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                        جستجو: {{ $currentSearch }}
                        <a href="{{ buildUrlWithout('search') }}" class="mr-1 text-blue-600 hover:text-blue-800">
                            <i class="fas fa-times"></i>
                        </a>
                    </span>
                @endif

                @if(getRequestValue('country'))
                    @php
                        $currentCountry = getRequestValue('country');
                        $selectedCountry = $countries->find($currentCountry);
                    @endphp
                    @if($selectedCountry)
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            کشور: {{ $selectedCountry->flag }} {{ $selectedCountry->name }}
                            <a href="{{ buildUrlWithout('country') }}" class="mr-1 text-blue-600 hover:text-blue-800">
                                <i class="fas fa-times"></i>
                            </a>
                        </span>
                    @endif
                @endif

                @if(getRequestValue('category'))
                    @php
                        $currentCategory = getRequestValue('category');
                        $selectedCategory = $categories->find($currentCategory);
                    @endphp
                    @if($selectedCategory)
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            دسته: {{ $selectedCategory->icon ?? '' }} {{ $selectedCategory->name }}
                            <a href="{{ buildUrlWithout('category') }}" class="mr-1 text-blue-600 hover:text-blue-800">
                                <i class="fas fa-times"></i>
                            </a>
                        </span>
                    @endif
                @endif

                @if(getRequestValue('iran_presence'))
                    @php
                        $presenceTexts = [
                            'official' => 'رسمی',
                            'unofficial' => 'غیررسمی',
                            'absent' => 'غایب'
                        ];
                        $currentPresence = getRequestValue('iran_presence');
                    @endphp
                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                        حضور در ایران: {{ $presenceTexts[$currentPresence] ?? $currentPresence }}
                        <a href="{{ buildUrlWithout('iran_presence') }}" class="mr-1 text-blue-600 hover:text-blue-800">
                            <i class="fas fa-times"></i>
                        </a>
                    </span>
                @endif

                @if(getRequestValue('brand_status'))
                    @php
                        $statusTexts = [
                            'active' => 'فعال',
                            'inactive' => 'غیرفعال',
                            'pending' => 'در انتظار'
                        ];
                        $currentStatus = getRequestValue('brand_status');
                    @endphp
                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                        وضعیت برند: {{ $statusTexts[$currentStatus] ?? $currentStatus }}
                        <a href="{{ buildUrlWithout('brand_status') }}" class="mr-1 text-blue-600 hover:text-blue-800">
                            <i class="fas fa-times"></i>
                        </a>
                    </span>
                @endif

                @if(getRequestValue('is_active') !== null)
                    @php
                        $currentActive = getRequestValue('is_active');
                    @endphp
                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                        وضعیت فعال: {{ $currentActive ? 'فعال' : 'غیرفعال' }}
                        <a href="{{ buildUrlWithout('is_active') }}" class="mr-1 text-blue-600 hover:text-blue-800">
                            <i class="fas fa-times"></i>
                        </a>
                    </span>
                @endif

                @if(getRequestValue('sort') && getRequestValue('sort') !== 'latest')
                    @php
                        $sortTexts = [
                            'oldest' => 'قدیمی‌ترین',
                            'name_asc' => 'نام (صعودی)',
                            'name_desc' => 'نام (نزولی)'
                        ];
                        $currentSort = getRequestValue('sort');
                    @endphp
                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                        مرتب‌سازی: {{ $sortTexts[$currentSort] ?? $currentSort }}
                        <a href="{{ buildUrlWithout('sort') }}" class="mr-1 text-blue-600 hover:text-blue-800">
                            <i class="fas fa-times"></i>
                        </a>
                    </span>
                @endif
            </div>
        </div>
    @endif

    <!-- Pagination Info -->
    @if($brands->hasPages())
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 mb-4">
            <div class="flex justify-between items-center text-sm text-gray-600">
                <div>
                    نمایش {{ $brands->firstItem() ?? 0 }} تا {{ $brands->lastItem() ?? 0 }} از {{ $brands->total() }} نتیجه
                    @if(getRequestValue('search') || getRequestValue('country') || getRequestValue('category') || getRequestValue('iran_presence') || getRequestValue('brand_status') || getRequestValue('is_active'))
                        (با فیلترهای اعمال شده)
                    @endif
                </div>
                <div>
                    صفحه {{ $brands->currentPage() }} از {{ $brands->lastPage() }}
                </div>
            </div>
        </div>
    @endif

    <!-- Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
            <div class="flex items-center">
                <div class="p-2 bg-blue-100 rounded-lg">
                    <i class="fas fa-building text-blue-600"></i>
                </div>
                <div class="mr-3">
                    <p class="text-sm text-gray-600">کل برندها</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $brands->total() }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
            <div class="flex items-center">
                <div class="p-2 bg-green-100 rounded-lg">
                    <i class="fas fa-check text-green-600"></i>
                </div>
                <div class="mr-3">
                    <p class="text-sm text-gray-600">فعال</p>
                    <p class="text-2xl font-bold text-gray-900">{{ \App\Models\Brand::active()->count() }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
            <div class="flex items-center">
                <div class="p-2 bg-yellow-100 rounded-lg">
                    <i class="fas fa-exclamation-triangle text-yellow-600"></i>
                </div>
                <div class="mr-3">
                    <p class="text-sm text-gray-600">غیررسمی در ایران</p>
                    <p class="text-2xl font-bold text-gray-900">{{ \App\Models\Brand::unofficialInIran()->count() }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
            <div class="flex items-center">
                <div class="p-2 bg-red-100 rounded-lg">
                    <i class="fas fa-times text-red-600"></i>
                </div>
                <div class="mr-3">
                    <p class="text-sm text-gray-600">غایب از ایران</p>
                    <p class="text-2xl font-bold text-gray-900">{{ \App\Models\Brand::absentFromIran()->count() }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Brands Table -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">برند</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">شرکت</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">کشور</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">دسته‌ها</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">وضعیت</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">حضور در ایران</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">عملیات</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($brands as $brand)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        @if($brand->logo)
                                            <img class="h-10 w-10 rounded-lg object-cover" src="{{ $brand->logo }}" alt="{{ $brand->name }}">
                                        @else
                                            <div class="h-10 w-10 rounded-lg bg-gray-100 flex items-center justify-center">
                                                <i class="fas fa-building text-gray-400"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="mr-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            <a href="{{ route('brands.show', $brand) }}" class="hover:underline text-blue-700">{{ $brand->name }}</a>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $brand->company_name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <span class="text-lg ml-2">{{ $brand->country->flag ?? '' }}</span>
                                    <span class="text-sm text-gray-900">{{ $brand->country->name ?? 'نامشخص' }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex flex-wrap gap-1">
                                    @foreach($brand->categories->take(2) as $category)
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            {{ $category->icon ?? '' }} {{ $category->name }}
                                            @if($category->pivot->is_primary)
                                                <span class="mr-1 text-xs bg-blue-200 px-1 rounded">اصلی</span>
                                            @endif
                                        </span>
                                    @endforeach
                                    @if($brand->categories->count() > 2)
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                            +{{ $brand->categories->count() - 2 }}
                                        </span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $brand->status_class }}">
                                    {{ $brand->status_text }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $brand->iran_presence_class }}">
                                    {{ $brand->iran_presence_text }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2 space-x-reverse">
                                    <a href="{{ route('brands.show', $brand) }}" class="text-blue-600 hover:text-blue-900">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('brands.edit', $brand) }}" class="text-indigo-600 hover:text-indigo-900">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('brands.destroy', $brand) }}" method="POST" class="inline" onsubmit="return confirm('آیا از حذف این برند اطمینان دارید؟')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                @if(getRequestValue('search') || getRequestValue('country') || getRequestValue('category') || getRequestValue('iran_presence') || getRequestValue('brand_status') || getRequestValue('is_active'))
                                    هیچ برندی با فیلترهای انتخاب شده یافت نشد.
                                    <br>
                                    <a href="{{ route('brands.index') }}" class="text-blue-600 hover:text-blue-800 mt-2 inline-block">
                                        پاک کردن فیلترها
                                    </a>
                                @else
                                    هیچ برندی یافت نشد.
                                @endif
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($brands->hasPages())
            <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                {{ $brands->links() }}
            </div>
        @endif
    </div>
</div>

<script>
function brandsIndex() {
    return {
        init() {
            // اضافه کردن منطق اضافی در صورت نیاز
        }
    }
}
</script>
@endsection
