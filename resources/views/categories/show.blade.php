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
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="mr-1 md:mr-2 text-sm font-medium text-gray-500">{{ $category->name }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Category Header -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
            <div class="p-6">
                <div class="flex justify-between items-start">
                    <div class="flex items-center">
                        <div class="text-4xl ml-4">{{ $category->icon ?? '📁' }}</div>
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900">{{ $category->name }}</h1>
                            @if($category->description)
                                <p class="text-gray-600 mt-2">{{ $category->description }}</p>
                            @endif
                            @if($category->parent)
                                <p class="text-sm text-gray-500 mt-1">زیرگروه: <a href="{{ route('categories.show', $category->parent) }}" class="text-indigo-600 hover:text-indigo-900">{{ $category->parent->name }}</a></p>
                            @endif
                        </div>
                    </div>
                    <div class="flex space-x-2 space-x-reverse">
                        <a href="{{ route('categories.edit', $category) }}" class="btn-primary">
                            ویرایش
                        </a>
                        @if($category->children()->count() == 0 && $category->brands()->count() == 0)
                            <form action="{{ route('categories.destroy', $category) }}" method="POST" class="inline" onsubmit="return confirm('آیا مطمئن هستید که می‌خواهید این دسته را حذف کنید؟')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded-lg transition duration-150 ease-in-out">
                                    حذف
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-8 w-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                </svg>
                            </div>
                            <div class="mr-2">
                                <div class="text-sm font-medium text-gray-500">زیرگروه‌ها</div>
                            </div>
                        </div>
                        <div class="text-lg font-medium text-gray-900 persian-numbers">{{ $category->children()->count() }}</div>
                    </div>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-8 w-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                            </div>
                            <div class="mr-2">
                                <div class="text-sm font-medium text-gray-500">برندها</div>
                            </div>
                        </div>
                        <div class="text-lg font-medium text-gray-900 persian-numbers">{{ $category->brands()->count() }}</div>
                    </div>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-8 w-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="mr-2">
                                <div class="text-sm font-medium text-gray-500">تاریخ ایجاد</div>
                            </div>
                        </div>
                        <div class="text-lg font-medium text-gray-900 persian-numbers">{{ $category->created_at->format('Y/m/d') }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- ستون سمت راست: لیست زیرگروه‌ها (1/3) -->
            <div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-lg font-semibold text-gray-900">زیرگروه‌ها</h2>
                            <a href="{{ route('categories.create', ['parent_id' => $category->id]) }}" class="btn-primary">افزودن زیرگروه</a>
                        </div>
                        <div class="space-y-4">
                            @foreach($category->children as $child)
                                <a href="{{ route('categories.show', $child) }}" class="block border border-gray-200 rounded-lg p-4 mb-2 flex items-center hover:shadow-md transition duration-150 ease-in-out cursor-pointer">
                                    <div class="flex items-center justify-between w-full">
                                        <div class="flex items-center">
                                            <div class="text-2xl ml-3">{{ $child->icon ?? '📁' }}</div>
                                            <h3 class="font-medium text-gray-900">{{ $child->name }}</h3>
                                        </div>
                                        <div class="text-xs text-gray-500 mt-1">{{ $child->brands()->count() }} برند</div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <!-- ستون سمت چپ: برندهای این دسته (2/3) -->
            <div class="lg:col-span-2">
                <!-- Brands Section -->
                @if($brands->count() > 0)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h2 class="text-xl font-semibold text-gray-900 mb-4">برندهای این دسته</h2>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 table">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">تصویر</th>
                                        <th class="px-4 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">نام برند</th>
                                        <th class="px-4 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">کشور</th>
                                        <th class="px-4 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">سطح برند</th>
                                        <th class="px-4 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">مالک</th>
                                        <th class="px-4 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">وضعیت</th>
                                        <th class="px-4 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">عملیات</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($brands as $brand)
                                    <tr>
                                        <td class="px-4 py-3 whitespace-nowrap">
                                            <img class="h-10 w-10 rounded-full object-cover mx-auto" src="{{ $brand->logo ?? '/images/default-brand.svg' }}" alt="{{ $brand->name }}">
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">
                                            <span class="flex items-start justify-start">
                                                <span>{{ $brand->country?->flag }}</span>
                                                <a href="{{ route('brands.show', $brand) }}" class="mr-1 text-blue-600 hover:text-blue-900 hover:underline">{{ $brand->name }}</a>
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900 text-center">{{ $brand->country?->name ?? '-' }}</td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900 text-center">
                                            @if($brand->level)
                                                <i class="{{ $brand->level->icon }} ml-1" style="color: {{ $brand->level->color }}"></i>
                                                <span>{{ $brand->level->display_name }}</span>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900 text-center">{{ $brand->owner?->name ?? '-' }}</td>
                                        <td class="px-4 py-3 whitespace-nowrap text-center">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                @if($brand->brand_status === 'listed') bg-blue-100 text-blue-800
                                                @elseif($brand->brand_status === 'started') bg-yellow-100 text-yellow-800
                                                @elseif($brand->brand_status === 'waiting') bg-orange-100 text-orange-800
                                                @elseif($brand->brand_status === 'rejected') bg-red-100 text-red-800
                                                @elseif($brand->brand_status === 'registered') bg-green-100 text-green-800
                                                @else bg-gray-100 text-gray-800 @endif">
                                                {{ [
                                                    'listed' => 'لیست شده',
                                                    'started' => 'شروع شده',
                                                    'waiting' => 'در انتظار',
                                                    'rejected' => 'رد شده',
                                                    'registered' => 'ثبت رسمی'
                                                ][$brand->brand_status] ?? 'نامشخص' }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm font-medium">
                                            <a href="{{ route('brands.show', $brand) }}" class="text-indigo-600 hover:text-indigo-900 ml-3">مشاهده</a>
                                            <a href="{{ route('brands.edit', $brand) }}" class="text-green-600 hover:text-green-900">ویرایش</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4">
                            {{ $brands->links() }}
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
