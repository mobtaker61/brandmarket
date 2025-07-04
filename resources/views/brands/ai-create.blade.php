@extends('layouts.app')
@section('title', 'افزودن برند با هوش مصنوعی')
@section('content')
<div class="container mx-auto px-4 py-8" x-data="aiBrandForm()">
    <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <h1 class="text-2xl font-bold mb-4">افزودن برند با هوش مصنوعی</h1>
        <form @submit.prevent="fetchAIInfo" class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">نام برند</label>
            <input type="text" x-model="brandName" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 mb-2">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors" :disabled="loading">
                <span x-show="!loading">دریافت اطلاعات با هوش مصنوعی</span>
                <span x-show="loading">در حال دریافت...</span>
            </button>
        </form>
        <template x-if="aiData">
            <form method="POST" action="{{ route('brands.ai_store') }}" @submit.prevent="submitForm">
                @csrf
                <input type="hidden" name="country_id" :value="aiData.country_id" x-show="aiData.country_id">
                <div x-show="!aiData.country_id">
                    <label class="block text-sm font-medium text-gray-700 mb-1">کشور *</label>
                    <select x-model="aiData.country_id" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                        <option value="">انتخاب کنید</option>
                        @foreach($countries as $country)
                            <option value="{{ $country->id }}">{{ $country->flag }} {{ $country->name }} ({{ $country->name_en }})</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">سطح برند</label>
                    <select x-model="aiData.brand_level_id" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                        <option value="">انتخاب کنید</option>
                        @foreach($brandLevels as $level)
                            <option value="{{ $level->id }}">{{ $level->display_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">مالک برند</label>
                    <select x-model="aiData.owner_id" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                        <option value="">انتخاب کنید</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->userType->display_name ?? 'نامشخص' }})</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">دسته‌بندی‌ها *</label>
                    <select x-model="aiData.category_ids" multiple class="w-full px-3 py-2 border border-gray-300 rounded-md" size="8">
                        @foreach($categories as $category)
                            @if(is_null($category->parent_id) && $category->children->count())
                                <optgroup label="{{ $category->name }}">
                                    @foreach($category->children as $child)
                                        <option value="{{ $child->id }}">&nbsp;&nbsp;&nbsp;{{ $child->name }}</option>
                                    @endforeach
                                </optgroup>
                            @elseif(is_null($category->parent_id))
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endif
                        @endforeach
                    </select>
                    <small class="text-gray-500">دسته‌های تطبیق یافته با صنعت به صورت خودکار انتخاب شده‌اند.</small>
                </div>
                <div class="grid grid-cols-1 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">نام برند</label>
                        <input type="text" name="name" x-model="aiData.name" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">کشور</label>
                        <input type="text" name="country" x-model="aiData.country_name" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">صنعت</label>
                        <input type="text" name="industry" x-model="aiData.industry" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">توضیح</label>
                        <textarea name="description" x-model="aiData.description" class="w-full px-3 py-2 border border-gray-300 rounded-md"></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">لوگو (URL)</label>
                        <input type="text" name="logo" x-model="aiData.logo" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                        <template x-if="aiData.logo">
                            <img :src="aiData.logo" class="h-16 mt-2 rounded border object-contain" alt="پیش‌نمایش لوگو">
                        </template>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">وبسایت</label>
                        <input type="text" name="website" x-model="aiData.website" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                    </div>
                </div>
                <button type="submit" class="mt-6 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-medium transition-colors" :disabled="submitting">
                    <span x-show="!submitting">ثبت برند</span>
                    <span x-show="submitting">در حال ثبت...</span>
                </button>
            </form>
        </template>
        <template x-if="error">
            <div class="mt-4 text-red-600" x-text="error"></div>
        </template>
    </div>
</div>
<script>
function aiBrandForm() {
    return {
        brandName: '',
        aiData: null,
        loading: false,
        error: '',
        submitting: false,
        fetchAIInfo() {
            this.loading = true;
            this.error = '';
            this.aiData = null;
            // چک برند تکراری قبل از ارسال به AI
            fetch('/api/brands/check-name?name=' + encodeURIComponent(this.brandName))
                .then(res => res.json())
                .then(check => {
                    if (check.exists) {
                        this.loading = false;
                        this.error = 'برندی با این نام قبلاً ثبت شده است.';
                        return;
                    }
                    // اگر تکراری نبود، درخواست به AI
                    fetch("{{ route('brands.ai_fetch') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ name: this.brandName })
                    })
                    .then(res => res.json())
                    .then(data => {
                        this.loading = false;
                        // اگر خروجی AI خالی یا ناقص بود
                        if (!data.success || !data.data || !data.data.name || !data.data.country_id || !data.data.industry) {
                            this.error = 'اطلاعاتی برای این برند یافت نشد یا ناقص است. لطفاً نام برند را دقیق‌تر وارد کنید.';
                            this.aiData = null;
                            return;
                        }
                        let ids = data.data.category_ids;
                        if (!Array.isArray(ids)) {
                            ids = ids ? [String(ids)] : [];
                        } else {
                            ids = ids.map(String);
                        }
                        ids = ids.filter(x => x && x !== 'null' && x !== 'undefined');
                        data.data.category_ids = [...ids];
                        this.aiData = data.data;
                    })
                    .catch(() => {
                        this.loading = false;
                        this.error = 'خطا در ارتباط با سرور.';
                    });
                })
                .catch(() => {
                    this.loading = false;
                    this.error = 'خطا در ارتباط با سرور.';
                });
        },
        submitForm() {
            this.submitting = true;
            this.error = '';
            const payload = {
                name: this.aiData.name,
                country_id: this.aiData.country_id,
                brand_level_id: this.aiData.brand_level_id || null,
                owner_id: this.aiData.owner_id || null,
                brand_status: this.aiData.brand_status || 'listed',
                iran_market_presence: this.aiData.iran_market_presence,
                is_active: this.aiData.is_active,
                description: this.aiData.description,
                category_ids: this.aiData.category_ids,
                website: this.aiData.website,
                logo: this.aiData.logo ? this.aiData.logo : null,
                company_name: this.aiData.company_name && this.aiData.company_name.trim() !== '' ? this.aiData.company_name : this.aiData.name,
                instagram: this.aiData.instagram || '',
                telegram: this.aiData.telegram || '',
                linkedin: this.aiData.linkedin || '',
                notes: this.aiData.notes || ''
            };
            fetch("{{ route('brands.ai_store') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(payload)
            })
            .then(res => res.json())
            .then(data => {
                this.submitting = false;
                if (data.success && data.redirect) {
                    window.location.href = data.redirect;
                } else {
                    this.error = data.message || 'خطا در ثبت برند.';
                }
            })
            .catch(() => {
                this.submitting = false;
                this.error = 'خطا در ارتباط با سرور.';
            });
        }
    }
}
</script>
@endsection
