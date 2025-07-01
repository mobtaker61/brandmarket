<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

# Brand Manager

سیستم شناسایی و ردیابی وضعیت برندهای معتبر جهانی در مارکت ایران

## معرفی

Brand Manager یک سیستم جامع برای مدیریت و تحلیل برندهای جهانی در بازار ایران است. این سیستم با استفاده از **TAAL STACK** توسعه یافته و قابلیت‌های زیر را ارائه می‌دهد:

- مدیریت اطلاعات برندها
- تحلیل وضعیت بازار
- گزارش‌گیری پیشرفته
- ردیابی رقبا

## تکنولوژی‌های استفاده شده

### TAAL STACK
- **T**ailwind CSS - برای استایل‌دهی
- **A**lpine.js - برای تعاملات frontend
- **A**xios - برای درخواست‌های HTTP
- **L**aravel - برای backend

## نصب و راه‌اندازی

### پیش‌نیازها
- PHP 8.2+
- Composer
- Node.js 18+
- MySQL/PostgreSQL

### مراحل نصب

1. **کلون کردن پروژه**
```bash
git clone <repository-url>
cd BrandManager
```

2. **نصب وابستگی‌ها**
```bash
composer install
npm install
```

3. **تنظیم محیط**
```bash
cp .env.example .env
php artisan key:generate
```

4. **تنظیم دیتابیس**
```bash
# تنظیم اطلاعات دیتابیس در فایل .env
php artisan migrate
```

5. **Build کردن assets**
```bash
npm run build
```

6. **اجرای پروژه**
```bash
php artisan serve
```

## ساختار پروژه

```
BrandManager/
├── app/
│   ├── Http/Controllers/
│   │   ├── BrandController.php
│   │   └── AnalyticsController.php
│   └── Models/
│       └── Brand.php
├── resources/
│   ├── js/
│   │   ├── app.js          # Alpine.js setup
│   │   └── bootstrap.js    # Axios setup
│   ├── css/
│   │   └── app.css         # Tailwind CSS
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php
│       └── home.blade.php
├── routes/
│   └── web.php
└── database/
    └── migrations/
```

## ویژگی‌های کلیدی

### 1. مدیریت برندها
- افزودن، ویرایش و حذف برندها
- آپلود لوگو و تصاویر
- مدیریت اطلاعات کامل برند

### 2. تحلیل‌ها
- آمار کلی سیستم
- تحلیل صنایع مختلف
- مقایسه برندها

### 3. گزارش‌گیری
- گزارش‌های PDF و Excel
- نمودارهای تعاملی
- خروجی داده‌ها

## API Endpoints

### برندها
- `GET /brands` - لیست برندها
- `POST /brands` - ایجاد برند جدید
- `GET /brands/{id}` - جزئیات برند
- `PUT /brands/{id}` - ویرایش برند
- `DELETE /brands/{id}` - حذف برند

### تحلیل‌ها
- `GET /analytics` - صفحه تحلیل‌ها
- `GET /api/stats` - آمار API
- `GET /api/brands/recent` - برندهای اخیر

## توسعه

### Alpine.js Components
```html
<div x-data="{ open: false }">
    <button @click="open = !open">Toggle</button>
    <div x-show="open">Content</div>
</div>
```

### API Calls
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

## مشارکت

برای مشارکت در پروژه:

1. Fork کنید
2. Branch جدید ایجاد کنید
3. تغییرات را commit کنید
4. Pull Request ارسال کنید

## لایسنس

این پروژه تحت لایسنس MIT منتشر شده است.

## پشتیبانی

برای سوالات و مشکلات:
- Issue در GitHub ایجاد کنید
- با تیم توسعه تماس بگیرید

---

**Brand Manager** - مدیریت هوشمند برندهای جهانی در ایران
