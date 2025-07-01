# TAAL STACK در Brand Manager

## معرفی
این پروژه با استفاده از **TAAL STACK** توسعه یافته است که شامل:

- **T**ailwind CSS - برای استایل‌دهی
- **A**lpine.js - برای تعاملات frontend
- **A**xios - برای درخواست‌های HTTP
- **L**aravel - برای backend

## ساختار پروژه

### فایل‌های اصلی TAAL STACK

#### 1. JavaScript Setup
- `resources/js/app.js` - تنظیمات اصلی Alpine.js و Axios
- `resources/js/bootstrap.js` - تنظیمات Axios

#### 2. CSS Setup
- `resources/css/app.css` - تنظیمات Tailwind CSS

#### 3. Layout
- `resources/views/layouts/app.blade.php` - Layout اصلی با Alpine.js

### کامپوننت‌های Alpine.js

#### صفحه اصلی (`resources/views/home.blade.php`)
- `statsData()` - مدیریت آمار و اطلاعات
- `recentBrands()` - مدیریت لیست برندهای اخیر

#### ویژگی‌های کلیدی
- **Reactive Data Binding** - با استفاده از `x-text` و `x-data`
- **Event Handling** - با استفاده از `@click`
- **Conditional Rendering** - با استفاده از `x-show` و `x-if`
- **API Integration** - با استفاده از Axios

## نحوه استفاده

### 1. Alpine.js Components
```html
<div x-data="{ open: false }">
    <button @click="open = !open">Toggle</button>
    <div x-show="open">Content</div>
</div>
```

### 2. API Calls با Axios
```javascript
async loadData() {
    try {
        const response = await axios.get('/api/data');
        this.data = response.data;
    } catch (error) {
        console.error('Error:', error);
    }
}
```

### 3. Tailwind CSS Classes
```html
<div class="bg-white shadow-sm rounded-lg p-6">
    <h2 class="text-xl font-semibold text-gray-900">عنوان</h2>
</div>
```

## API Endpoints

### Stats API
- `GET /api/stats` - دریافت آمار کلی

### Brands API
- `GET /api/brands/recent` - دریافت برندهای اخیر

## مزایای TAAL STACK

1. **سادگی** - بدون نیاز به build process پیچیده
2. **سرعت** - بارگذاری سریع و عملکرد بهینه
3. **انعطاف‌پذیری** - امکان استفاده از هر سه تکنولوژی به صورت مستقل
4. **تجربه توسعه** - Hot reload و debugging آسان

## مراحل بعدی

1. تکمیل صفحات برندها
2. اضافه کردن سیستم احراز هویت
3. پیاده‌سازی تحلیل‌های پیشرفته
4. اضافه کردن گزارش‌گیری

## نکات مهم

- تمام کامپوننت‌های Alpine.js در فایل‌های Blade تعریف شده‌اند
- از Axios برای تمام درخواست‌های AJAX استفاده می‌شود
- Tailwind CSS برای تمام استایل‌ها استفاده می‌شود
- Laravel برای backend و routing استفاده می‌شود 
