@extends('layouts.app')

@section('title', $brand->name . ' - مشاهده برند')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $brand->name }}</h1>
                <p class="text-gray-600">{{ $brand->company_name }}</p>
            </div>
            <div class="flex space-x-2 space-x-reverse">
                <a href="{{ route('brands.edit', $brand) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                    <i class="fas fa-edit ml-2"></i>
                    ویرایش
                </a>
                <a href="{{ route('brands.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                    <i class="fas fa-arrow-right ml-2"></i>
                    بازگشت
                </a>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Info -->
        <div class="lg:col-span-2">
            <!-- Basic Information -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">اطلاعات پایه</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">نام برند</label>
                        <p class="text-gray-900">{{ $brand->name }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">نام شرکت</label>
                        <p class="text-gray-900">{{ $brand->company_name }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">کشور</label>
                        <div class="flex items-center">
                            <span class="text-lg ml-2">{{ $brand->country->flag ?? '' }}</span>
                            <span class="text-gray-900">{{ $brand->country->name ?? 'نامشخص' }}</span>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">وضعیت برند</label>
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $brand->status_class }}">
                            {{ $brand->status_text }}
                        </span>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">حضور در بازار ایران</label>
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $brand->iran_presence_class }}">
                            {{ $brand->iran_presence_text }}
                        </span>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">فعال</label>
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $brand->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $brand->is_active ? 'بله' : 'خیر' }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Description -->
            @if($brand->description)
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">توضیحات</h2>
                <p class="text-gray-700 leading-relaxed">{{ $brand->description }}</p>
            </div>
            @endif

            <!-- Categories -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">دسته‌های محصولات</h2>
                <div class="flex flex-wrap gap-2">
                    @forelse($brand->categories as $category)
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                            {{ $category->icon ?? '' }} {{ $category->name }}
                            @if($category->pivot->is_primary)
                                <span class="mr-1 text-xs bg-blue-200 px-1 rounded">اصلی</span>
                            @endif
                        </span>
                    @empty
                        <p class="text-gray-500">هیچ دسته‌ای تعریف نشده است.</p>
                    @endforelse
                </div>
            </div>

            <!-- Notes -->
            @if($brand->notes)
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">یادداشت‌ها</h2>
                <p class="text-gray-700 leading-relaxed">{{ $brand->notes }}</p>
            </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <!-- Logo -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">لوگو</h2>
                @if($brand->logo)
                    <img src="{{ $brand->logo }}" alt="{{ $brand->name }}" class="w-full h-32 object-contain rounded-lg">
                @else
                    <div class="w-full h-32 bg-gray-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-image text-gray-400 text-3xl"></i>
                    </div>
                @endif
            </div>

            <!-- Contact Information -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">اطلاعات تماس</h2>
                <div class="space-y-3">
                    @if($brand->website)
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">وبسایت</label>
                        <a href="{{ $brand->website }}" target="_blank" class="text-blue-600 hover:text-blue-800 break-all">
                            {{ $brand->website }}
                        </a>
                    </div>
                    @endif

                    @if($brand->instagram)
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">اینستاگرام</label>
                        <a href="https://instagram.com/{{ $brand->instagram }}" target="_blank" class="text-pink-600 hover:text-pink-800">
                            @{{ {{ $brand->instagram }} }}
                        </a>
                    </div>
                    @endif

                    @if($brand->telegram)
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">تلگرام</label>
                        <a href="https://t.me/{{ $brand->telegram }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                            @{{ {{ $brand->telegram }} }}
                        </a>
                    </div>
                    @endif

                    @if($brand->linkedin)
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">لینکدین</label>
                        <a href="https://linkedin.com/company/{{ $brand->linkedin }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                            {{ $brand->linkedin }}
                        </a>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">عملیات سریع</h2>
                <div class="space-y-2">
                    <a href="{{ route('brands.edit', $brand) }}" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg font-medium transition-colors text-center block">
                        <i class="fas fa-edit ml-2"></i>
                        ویرایش برند
                    </a>
                    <button onclick="deleteBrand({{ $brand->id }})" class="w-full bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                        <i class="fas fa-trash ml-2"></i>
                        حذف برند
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function deleteBrand(brandId) {
    if (confirm('آیا از حذف این برند اطمینان دارید؟')) {
        fetch(`/brands/${brandId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        }).then(response => {
            if (response.ok) {
                window.location.href = '/brands';
            }
        });
    }
}
</script>
@endsection
