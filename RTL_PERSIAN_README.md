# پیاده‌سازی RTL و فارسی - Brand Manager

## معرفی

Brand Manager به طور کامل برای زبان فارسی و جهت RTL (راست به چپ) بهینه‌سازی شده است. این شامل فونت فارسی، اعداد فارسی، تاریخ میلادی با فرمت فارسی و تمام عناصر UI می‌شود.

## ویژگی‌های پیاده‌سازی شده

### 1. **فونت فارسی**
- استفاده از فونت **Vazirmatn** برای نمایش بهتر متون فارسی
- پشتیبانی از وزن‌های مختلف (300, 400, 500, 600, 700)
- بهینه‌سازی شده برای خوانایی بهتر

### 2. **جهت RTL**
- تنظیم `dir="rtl"` در HTML
- بهینه‌سازی تمام عناصر UI برای RTL
- تنظیم margin و padding برای جهت راست به چپ

### 3. **اعداد فارسی**
- تبدیل خودکار اعداد انگلیسی به فارسی
- کلاس CSS `persian-numbers` برای اعداد
- Helper functions برای تبدیل اعداد

### 4. **تاریخ میلادی با فرمت فارسی**
- استفاده از تاریخ میلادی در دیتابیس
- نمایش تاریخ با اعداد فارسی
- پشتیبانی از Carbon objects
- فرمت‌بندی مناسب برای نمایش

### 5. **Blade Directives**
- `@persian()` - تبدیل اعداد به فارسی
- `@formatNumber()` - فرمت اعداد با جداکننده
- `@persianDate()` - نمایش تاریخ میلادی با اعداد فارسی
- `@persianDateTime()` - نمایش تاریخ و زمان میلادی با اعداد فارسی
- `@currency()` - فرمت پول

## ساختار فایل‌ها

### CSS (resources/css/app.css)
```css
/* فونت فارسی */
--font-sans: 'Vazirmatn', ui-sans-serif, system-ui, sans-serif;

/* تنظیمات RTL */
[dir="rtl"] {
    direction: rtl;
    text-align: right;
}

/* کلاس اعداد فارسی */
.persian-numbers {
    font-feature-settings: "tnum";
    font-variant-numeric: tabular-nums;
}
```

### Helper (app/Helpers/PersianHelper.php)
```php
// تبدیل اعداد
PersianHelper::toPersianNumbers('123'); // ۱۲۳

// فرمت اعداد
PersianHelper::formatNumber(1234567); // ۱,۲۳۴,۵۶۷

// تاریخ میلادی با اعداد فارسی
PersianHelper::formatDateForDisplay('2024-01-15'); // ۲۰۲۴/۰۱/۱۵
PersianHelper::formatDateTimeForDisplay('2024-01-15 14:30'); // ۲۰۲۴/۰۱/۱۵ ۱۴:۳۰
```

### Blade Directives
```blade
{{-- اعداد فارسی --}}
@persian(123) {{-- ۱۲۳ --}}

{{-- فرمت اعداد --}}
@formatNumber(1234567) {{-- ۱,۲۳۴,۵۶۷ --}}

{{-- تاریخ میلادی فارسی --}}
@persianDate($brand->created_at) {{-- ۲۰۲۴/۰۱/۱۵ --}}

{{-- تاریخ و زمان میلادی فارسی --}}
@persianDateTime($brand->updated_at) {{-- ۲۰۲۴/۰۱/۱۵ ۱۴:۳۰ --}}

{{-- پول --}}
@currency(50000) {{-- ۵۰,۰۰۰ تومان --}}
```

## نحوه استفاده

### 1. **در Blade Templates**
```blade
<div class="persian-numbers">
    تعداد برندها: @persian($totalBrands)
</div>

<div class="text-right">
    تاریخ ایجاد: @persianDate($brand->created_at)
</div>

<div class="text-left">
    قیمت: @currency($price)
</div>
```

### 2. **در Alpine.js**
```javascript
// تبدیل اعداد در JavaScript
function toPersianNumbers(num) {
    const persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
    return num.toString().replace(/\d/g, x => persian[x]);
}

// استفاده در Alpine.js
x-text="toPersianNumbers(stats.totalBrands)"
```

### 3. **در CSS Classes**
```html
<!-- اعداد فارسی -->
<span class="persian-numbers">123</span>

<!-- متن راست چین -->
<div class="text-right">متن فارسی</div>

<!-- فاصله‌گذاری RTL -->
<div class="space-x-4 space-x-reverse">
    <span>عنوان ۱</span>
    <span>عنوان ۲</span>
</div>
```

## تنظیمات RTL

### 1. **Navigation**
- منوها از راست به چپ
- Dropdown ها در سمت چپ
- آیکون‌ها در سمت راست

### 2. **Tables**
- محتوا راست چین
- Header ها راست چین
- فاصله‌گذاری مناسب

### 3. **Forms**
- Label ها در سمت راست
- Input ها راست چین
- دکمه‌ها در سمت چپ

### 4. **Cards**
- محتوا راست چین
- آیکون‌ها در سمت راست
- دکمه‌ها در سمت چپ

## کلاس‌های CSS مفید

### RTL Utilities
```css
.rtl\:space-x-reverse  /* فاصله معکوس */
.rtl\:text-right       /* متن راست */
.rtl\:mr-0            /* margin راست صفر */
.rtl\:ml-0            /* margin چپ صفر */
.rtl\:flex-row-reverse /* flex معکوس */
```

### Persian Numbers
```css
.persian-numbers {
    font-feature-settings: "tnum";
    font-variant-numeric: tabular-nums;
}
```

### Custom Buttons
```css
.btn-primary {
    @apply bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-lg transition duration-150 ease-in-out;
}

.btn-secondary {
    @apply bg-gray-600 hover:bg-gray-700 text-white font-medium py-2 px-4 rounded-lg transition duration-150 ease-in-out;
}
```

## نکات مهم

### 1. **فونت‌ها**
- فونت Vazirmatn از Google Fonts لود می‌شود
- پشتیبانی از تمام کاراکترهای فارسی
- بهینه‌سازی شده برای نمایش بهتر

### 2. **اعداد**
- تبدیل خودکار در Helper
- پشتیبانی از اعداد اعشاری
- فرمت‌بندی با جداکننده هزارگان

### 3. **تاریخ**
- استفاده از تاریخ میلادی در دیتابیس
- نمایش با اعداد فارسی
- پشتیبانی از Carbon objects
- فرمت استاندارد Y/m/d

### 4. **Responsive**
- سازگار با تمام دستگاه‌ها
- حفظ RTL در موبایل
- بهینه‌سازی برای تبلت

## مراحل بعدی

1. **بهینه‌سازی فونت**
   - فونت‌های محلی
   - کاهش زمان بارگذاری
   - پشتیبانی از فونت‌های مختلف

2. **ویژگی‌های اضافی**
   - تبدیل واحدها
   - فرمت‌بندی پیشرفته
   - پشتیبانی از زبان‌های دیگر

3. **کش کردن**
   - کش کردن helper functions
   - بهینه‌سازی عملکرد
   - کاهش بار سرور

## منابع مفید

- [فونت Vazirmatn](https://github.com/aminabedi68/Vazirmatn)
- [RTL CSS Guide](https://rtlcss.com/)
- [Carbon Documentation](https://carbon.nesbot.com/)
- [RTL Bootstrap](https://getbootstrap.com/docs/5.3/getting-started/rtl/)

---

**Brand Manager** - بهینه‌سازی شده برای فارسی و RTL با تاریخ میلادی
