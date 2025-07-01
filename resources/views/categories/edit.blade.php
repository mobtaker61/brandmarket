@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <nav class="flex mb-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3 space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-indigo-600">
                        <svg class="w-4 h-4 ml-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                        </svg>
                        خانه
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <a href="{{ route('categories.index') }}" class="mr-1 md:mr-2 text-sm font-medium text-gray-700 hover:text-indigo-600">دسته‌ها</a>
                    </div>
                </li>
                @if($category->parent)
                <li>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <a href="{{ route('categories.show', $category->parent) }}" class="mr-1 md:mr-2 text-sm font-medium text-gray-700 hover:text-indigo-600">{{ $category->parent->name }}</a>
                    </div>
                </li>
                @endif
                <li>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <a href="{{ route('categories.show', $category) }}" class="mr-1 md:mr-2 text-sm font-medium text-gray-700 hover:text-indigo-600">{{ $category->name }}</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="mr-1 md:mr-2 text-sm font-medium text-gray-500">ویرایش</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Form Card -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold text-gray-900">ویرایش دسته: {{ $category->name }}</h1>
                    <a href="{{ route('categories.show', $category) }}" class="text-indigo-600 hover:text-indigo-900 text-sm font-medium">
                        ← بازگشت به جزئیات
                    </a>
                </div>

                <form action="{{ route('categories.update', $category) }}" method="POST" x-data="categoryForm()">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- نام دسته -->
                        <div class="md:col-span-2">
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">نام دسته *</label>
                            <input type="text"
                                   name="name"
                                   id="name"
                                   value="{{ old('name', $category->name) }}"
                                   class="form-input w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                   placeholder="مثال: مواد غذایی و نوشیدنی"
                                   required>
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- توضیحات -->
                        <div class="md:col-span-2">
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">توضیحات</label>
                            <textarea name="description"
                                      id="description"
                                      rows="3"
                                      class="form-textarea w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                      placeholder="توضیحات مربوط به این دسته...">{{ old('description', $category->description) }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- آیکون -->
                        <div>
                            <label for="icon" class="block text-sm font-medium text-gray-700 mb-2">آیکون</label>
                            <div class="relative">
                                <input type="text"
                                       name="icon"
                                       id="icon"
                                       value="{{ old('icon', $category->icon) }}"
                                       x-model="selectedIcon"
                                       class="form-input w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                       placeholder="🍽️">
                                <div class="absolute left-3 top-1/2 transform -translate-y-1/2 text-2xl" x-text="selectedIcon || '📁'"></div>
                            </div>
                            <p class="mt-1 text-sm text-gray-500">می‌توانید از ایموجی یا کد یونیکد استفاده کنید</p>
                            @error('icon')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- رنگ -->
                        <div>
                            <label for="color" class="block text-sm font-medium text-gray-700 mb-2">رنگ</label>
                            <input type="color"
                                   name="color"
                                   id="color"
                                   value="{{ old('color', $category->color ?? '#3B82F6') }}"
                                   x-model="selectedColor"
                                   class="form-input w-full h-10 rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                            @error('color')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- دسته والد -->
                        <div class="md:col-span-2">
                            <label for="parent_id" class="block text-sm font-medium text-gray-700 mb-2">دسته والد (اختیاری)</label>
                            <select name="parent_id"
                                    id="parent_id"
                                    class="form-select w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">بدون دسته والد (دسته اصلی)</option>
                                @foreach($parentCategories as $parent)
                                    <option value="{{ $parent->id }}" {{ old('parent_id', $category->parent_id) == $parent->id ? 'selected' : '' }}>
                                        {{ $parent->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('parent_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- پیش‌نمایش -->
                    <div class="mt-8 p-4 bg-gray-50 rounded-lg">
                        <h3 class="text-sm font-medium text-gray-700 mb-3">پیش‌نمایش</h3>
                        <div class="flex items-center p-3 bg-white rounded border">
                            <div class="text-3xl ml-3" x-text="selectedIcon || '📁'"></div>
                            <div>
                                <h4 class="font-medium text-gray-900" x-text="name || 'نام دسته'"></h4>
                                <p class="text-sm text-gray-500" x-text="description || 'توضیحات دسته'"></p>
                            </div>
                        </div>
                    </div>

                    <!-- اطلاعات اضافی -->
                    <div class="mt-8 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                        <h3 class="text-sm font-medium text-blue-900 mb-3">اطلاعات دسته</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                            <div>
                                <span class="text-blue-700">تاریخ ایجاد:</span>
                                <span class="text-blue-900">@persianDate($category->created_at)</span>
                            </div>
                            <div>
                                <span class="text-blue-700">آخرین بروزرسانی:</span>
                                <span class="text-blue-900">@persianDate($category->updated_at)</span>
                            </div>
                            <div>
                                <span class="text-blue-700">تعداد زیرگروه‌ها:</span>
                                <span class="text-blue-900 persian-numbers">{{ $category->children()->count() }}</span>
                            </div>
                            <div>
                                <span class="text-blue-700">تعداد برندها:</span>
                                <span class="text-blue-900 persian-numbers">{{ $category->brands()->count() }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- دکمه‌های عملیات -->
                    <div class="flex justify-between items-center mt-8">
                        <div class="flex space-x-2 space-x-reverse">
                            @if($category->children()->count() == 0 && $category->brands()->count() == 0)
                                <form action="{{ route('categories.destroy', $category) }}" method="POST" class="inline" onsubmit="return confirm('آیا مطمئن هستید که می‌خواهید این دسته را حذف کنید؟')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded-lg transition duration-150 ease-in-out">
                                        حذف دسته
                                    </button>
                                </form>
                            @endif
                        </div>
                        <div class="flex space-x-2 space-x-reverse">
                            <a href="{{ route('categories.show', $category) }}" class="btn-secondary">
                                انصراف
                            </a>
                            <button type="submit" class="btn-primary">
                                ذخیره تغییرات
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- آیکون‌های پیشنهادی -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-8">
            <div class="p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">آیکون‌های پیشنهادی</h3>
                <div class="grid grid-cols-8 md:grid-cols-16 gap-2" x-data="{ selectedIcon: '{{ $category->icon ?? '📁' }}' }">
                    @php
                        $suggestedIcons = [
                            '🍽️', '💄', '👕', '📱', '🚗', '⚽', '🏠', '💊',
                            '📚', '🎮', '🎵', '🎬', '✈️', '🏥', '🏦', '🎨',
                            '🔧', '💻', '📺', '🎪', '🏖️', '🎯', '🎲', '🎭',
                            '📷', '🎤', '🎧', '🎹', '🎸', '🎺', '🥁', '🎻'
                        ];
                    @endphp
                    @foreach($suggestedIcons as $icon)
                        <button type="button"
                                @click="selectedIcon = '{{ $icon }}'; $refs.iconInput.value = '{{ $icon }}'"
                                class="text-2xl p-2 rounded hover:bg-gray-100 transition duration-150 ease-in-out"
                                :class="selectedIcon === '{{ $icon }}' ? 'bg-indigo-100 border-2 border-indigo-300' : ''">
                            {{ $icon }}
                        </button>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function categoryForm() {
    return {
        name: '{{ $category->name }}',
        description: '{{ $category->description ?? '' }}',
        selectedIcon: '{{ $category->icon ?? '📁' }}',
        selectedColor: '{{ $category->color ?? '#3B82F6' }}',
        init() {
            // تنظیم مقادیر اولیه از فیلدهای فرم
            this.name = this.$refs.nameInput?.value || '{{ $category->name }}';
            this.description = this.$refs.descriptionInput?.value || '{{ $category->description ?? '' }}';
            this.selectedIcon = this.$refs.iconInput?.value || '{{ $category->icon ?? '📁' }}';
            this.selectedColor = this.$refs.colorInput?.value || '{{ $category->color ?? '#3B82F6' }}';
        }
    }
}
</script>
@endsection
