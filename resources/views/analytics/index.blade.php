@extends('layouts.app')

@section('content')
<div class="py-4">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">تحلیل و آمار</h1>
            <p class="mt-2 text-gray-600">نمای کلی از وضعیت برندها و آمار سیستم</p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
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
                                <dd class="text-lg font-medium text-gray-900 persian-numbers">{{ $totalBrands }}</dd>
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
                                <dd class="text-lg font-medium text-gray-900 persian-numbers">{{ $activeBrands }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-8 w-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="mr-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">برندهای غیرفعال</dt>
                                <dd class="text-lg font-medium text-gray-900 persian-numbers">{{ $inactiveBrands }}</dd>
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
                                <dt class="text-sm font-medium text-gray-500 truncate">نرخ فعال بودن</dt>
                                <dd class="text-lg font-medium text-gray-900 persian-numbers">
                                    {{ $totalBrands > 0 ? round(($activeBrands / $totalBrands) * 100, 1) : 0 }}%
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
            <!-- Categories Chart -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">توزیع برندها بر اساس دسته‌بندی</h3>
                    <div class="space-y-3">
                        @forelse($categoryStats as $category)
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">{{ $category['name'] }}</span>
                                <div class="flex items-center">
                                    <div class="w-32 bg-gray-200 rounded-full h-2 ml-3">
                                        @php
                                            $percentage = $totalBrands > 0 ? ($category['count'] / $totalBrands) * 100 : 0;
                                        @endphp
                                        <div class="bg-indigo-600 h-2 rounded-full" style="width: {{ $percentage }}%"></div>
                                    </div>
                                    <span class="text-sm font-medium text-gray-900 persian-numbers">{{ $category['count'] }}</span>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500 text-center py-4">هیچ داده‌ای موجود نیست</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Countries Chart -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">توزیع برندها بر اساس کشور</h3>
                    <div class="space-y-3">
                        @forelse($countryStats as $country)
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">{{ $country['name'] }}</span>
                                <div class="flex items-center">
                                    <div class="w-32 bg-gray-200 rounded-full h-2 ml-3">
                                        @php
                                            $percentage = $totalBrands > 0 ? ($country['count'] / $totalBrands) * 100 : 0;
                                        @endphp
                                        <div class="bg-green-600 h-2 rounded-full" style="width: {{ $percentage }}%"></div>
                                    </div>
                                    <span class="text-sm font-medium text-gray-900 persian-numbers">{{ $country['count'] }}</span>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500 text-center py-4">هیچ داده‌ای موجود نیست</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <!-- آمار وضعیت برندها -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
            <div class="p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">توزیع برندها بر اساس وضعیت</h3>
                <div class="space-y-3">
                    @forelse($statusStats as $status)
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">{{ $status['name'] }}</span>
                            <div class="flex items-center">
                                <div class="w-32 bg-gray-200 rounded-full h-2 ml-3">
                                    @php
                                        $percentage = $totalBrands > 0 ? ($status['count'] / $totalBrands) * 100 : 0;
                                    @endphp
                                    <div class="bg-blue-600 h-2 rounded-full" style="width: {{ $percentage }}%"></div>
                                </div>
                                <span class="text-sm font-medium text-gray-900 persian-numbers">{{ $status['count'] }}</span>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-4">هیچ داده‌ای موجود نیست</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Export Section -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">خروجی گزارش</h3>
                <div class="flex space-x-4 space-x-reverse">
                    <button onclick="exportReport('pdf')" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700">
                        <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        خروجی PDF
                    </button>
                    <button onclick="exportReport('excel')" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700">
                        <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        خروجی Excel
                    </button>
                    <button onclick="exportReport('csv')" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                        <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        خروجی CSV
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function exportReport(format) {
    // نمایش loading
    const button = event.target;
    const originalText = button.innerHTML;
    button.innerHTML = '<svg class="animate-spin ml-2 h-4 w-4" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> در حال تولید...';
    button.disabled = true;

    fetch(`/analytics/export?format=${format}`, {
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.download_url) {
            window.open(data.download_url, '_blank');
        }
        alert('گزارش با موفقیت تولید شد');
    })
    .catch(error => {
        console.error('خطا در تولید گزارش:', error);
        alert('خطا در تولید گزارش');
    })
    .finally(() => {
        button.innerHTML = originalText;
        button.disabled = false;
    });
}
</script>
@endsection
