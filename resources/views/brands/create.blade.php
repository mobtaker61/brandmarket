@extends('layouts.app')

@section('title', 'افزودن برند جدید')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">افزودن برند جدید</h1>
                <p class="text-gray-600">ثبت اطلاعات برند جدید در سیستم</p>
            </div>
            <a href="{{ route('brands.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                <i class="fas fa-arrow-right ml-2"></i>
                بازگشت
            </a>
        </div>
    </div>

    <div class="max-w-4xl mx-auto">
        <form action="{{ route('brands.store') }}" method="POST" enctype="multipart/form-data" x-data="brandForm()">
            @csrf

            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <!-- Basic Information -->
                <h2 class="text-xl font-semibold text-gray-900 mb-6">اطلاعات پایه</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">نام برند *</label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror"
                            required
                        >
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="company_name" class="block text-sm font-medium text-gray-700 mb-2">نام شرکت *</label>
                        <input
                            type="text"
                            id="company_name"
                            name="company_name"
                            value="{{ old('company_name') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('company_name') border-red-500 @enderror"
                            required
                        >
                        @error('company_name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="country_id" class="block text-sm font-medium text-gray-700 mb-2">کشور *</label>
                        <select
                            id="country_id"
                            name="country_id"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('country_id') border-red-500 @enderror"
                            required
                        >
                            <option value="">انتخاب کنید</option>
                            @foreach($countries as $country)
                                <option value="{{ $country->id }}" {{ old('country_id') == $country->id ? 'selected' : '' }}>
                                    {{ $country->flag }} {{ $country->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('country_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="brand_level_id" class="block text-sm font-medium text-gray-700 mb-2">سطح برند</label>
                        <select
                            id="brand_level_id"
                            name="brand_level_id"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('brand_level_id') border-red-500 @enderror"
                        >
                            <option value="">انتخاب کنید</option>
                            @foreach($brandLevels as $level)
                                <option value="{{ $level->id }}" {{ old('brand_level_id') == $level->id ? 'selected' : '' }}>
                                    {{ $level->display_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('brand_level_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="owner_id" class="block text-sm font-medium text-gray-700 mb-2">مالک برند</label>
                        <select
                            id="owner_id"
                            name="owner_id"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('owner_id') border-red-500 @enderror"
                        >
                            <option value="">انتخاب کنید</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ old('owner_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }} ({{ $user->userType->display_name ?? 'نامشخص' }})
                                </option>
                            @endforeach
                        </select>
                        @error('owner_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="brand_status" class="block text-sm font-medium text-gray-700 mb-2">وضعیت برند *</label>
                        <select
                            id="brand_status"
                            name="brand_status"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('brand_status') border-red-500 @enderror"
                            required
                        >
                                                    <option value="listed" {{ old('brand_status') == 'listed' ? 'selected' : '' }}>لیست شده</option>
                        <option value="started" {{ old('brand_status') == 'started' ? 'selected' : '' }}>شروع شده</option>
                        <option value="waiting" {{ old('brand_status') == 'waiting' ? 'selected' : '' }}>در انتظار</option>
                        <option value="rejected" {{ old('brand_status') == 'rejected' ? 'selected' : '' }}>رد شده</option>
                        <option value="registered" {{ old('brand_status') == 'registered' ? 'selected' : '' }}>ثبت رسمی</option>
                        </select>
                        @error('brand_status')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="iran_market_presence" class="block text-sm font-medium text-gray-700 mb-2">حضور در بازار ایران *</label>
                        <select
                            id="iran_market_presence"
                            name="iran_market_presence"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('iran_market_presence') border-red-500 @enderror"
                            required
                        >
                            <option value="official" {{ old('iran_market_presence') == 'official' ? 'selected' : '' }}>رسمی</option>
                            <option value="unofficial" {{ old('iran_market_presence') == 'unofficial' ? 'selected' : '' }}>غیررسمی</option>
                            <option value="absent" {{ old('iran_market_presence') == 'absent' ? 'selected' : '' }}>غایب</option>
                        </select>
                        @error('iran_market_presence')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="is_active" class="block text-sm font-medium text-gray-700 mb-2">فعال</label>
                        <div class="flex items-center">
                            <input
                                type="checkbox"
                                id="is_active"
                                name="is_active"
                                value="1"
                                {{ old('is_active', true) ? 'checked' : '' }}
                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                            >
                            <label for="is_active" class="mr-2 text-sm text-gray-700">بله</label>
                        </div>
                        @error('is_active')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Description -->
                <div class="mt-6">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">توضیحات</label>
                    <textarea
                        id="description"
                        name="description"
                        rows="4"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('description') border-red-500 @enderror"
                        placeholder="توضیحات مربوط به برند..."
                    >{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Categories -->
                <div class="mt-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">دسته‌های محصولات</label>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3 max-h-48 overflow-y-auto border border-gray-300 rounded-md p-3">
                        @foreach($categories as $category)
                            <div class="flex items-center">
                                <input
                                    type="checkbox"
                                    id="category_{{ $category->id }}"
                                    name="category_ids[]"
                                    value="{{ $category->id }}"
                                    {{ in_array($category->id, old('category_ids', [])) ? 'checked' : '' }}
                                    class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                                >
                                <label for="category_{{ $category->id }}" class="mr-2 text-sm text-gray-700">
                                    {{ $category->icon ?? '' }} {{ $category->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                    <p class="text-xs text-gray-500 mt-1">اولین دسته انتخاب شده به عنوان دسته اصلی در نظر گرفته می‌شود.</p>
                    @error('category_ids')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Contact Information -->
                <h2 class="text-xl font-semibold text-gray-900 mb-6 mt-8">اطلاعات تماس</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="website" class="block text-sm font-medium text-gray-700 mb-2">وبسایت</label>
                        <input
                            type="url"
                            id="website"
                            name="website"
                            value="{{ old('website') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('website') border-red-500 @enderror"
                            placeholder="https://example.com"
                        >
                        @error('website')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="instagram" class="block text-sm font-medium text-gray-700 mb-2">اینستاگرام</label>
                        <input
                            type="text"
                            id="instagram"
                            name="instagram"
                            value="{{ old('instagram') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('instagram') border-red-500 @enderror"
                            placeholder="username"
                        >
                        @error('instagram')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="telegram" class="block text-sm font-medium text-gray-700 mb-2">تلگرام</label>
                        <input
                            type="text"
                            id="telegram"
                            name="telegram"
                            value="{{ old('telegram') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('telegram') border-red-500 @enderror"
                            placeholder="username"
                        >
                        @error('telegram')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="linkedin" class="block text-sm font-medium text-gray-700 mb-2">لینکدین</label>
                        <input
                            type="text"
                            id="linkedin"
                            name="linkedin"
                            value="{{ old('linkedin') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('linkedin') border-red-500 @enderror"
                            placeholder="company-name"
                        >
                        @error('linkedin')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="logo" class="block text-sm font-medium text-gray-700 mb-2">لوگو (URL یا آپلود)</label>
                        <input
                            type="url"
                            id="logo"
                            name="logo"
                            value="{{ old('logo') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('logo') border-red-500 @enderror mb-2"
                            placeholder="https://example.com/logo.png"
                        >
                        <input
                            type="file"
                            id="logo_file"
                            name="logo_file"
                            accept="image/*"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('logo_file') border-red-500 @enderror mb-2"
                        >
                        <template x-if="$refs.logo_file && $refs.logo_file.files && $refs.logo_file.files[0]">
                            <img :src="URL.createObjectURL($refs.logo_file.files[0])" class="h-16 mt-2 rounded border object-contain" alt="پیش‌نمایش لوگو">
                        </template>
                        @error('logo')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        @error('logo_file')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Notes -->
                <div class="mt-6">
                    <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">یادداشت‌ها</label>
                    <textarea
                        id="notes"
                        name="notes"
                        rows="3"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('notes') border-red-500 @enderror"
                        placeholder="یادداشت‌های اضافی..."
                    >{{ old('notes') }}</textarea>
                    @error('notes')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Buttons -->
                <div class="flex justify-end space-x-2 space-x-reverse mt-8">
                    <a href="{{ route('brands.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded-lg font-medium transition-colors">
                        انصراف
                    </a>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition-colors">
                        <i class="fas fa-save ml-2"></i>
                        ذخیره برند
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
function brandForm() {
    return {
        init() {
            // اضافه کردن منطق اضافی در صورت نیاز
        }
    }
}
</script>
@endsection
