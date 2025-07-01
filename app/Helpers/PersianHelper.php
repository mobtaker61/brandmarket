<?php

namespace App\Helpers;

use Carbon\Carbon;

class PersianHelper
{
    /**
     * تبدیل اعداد انگلیسی به فارسی
     */
    public static function toPersianNumbers($string)
    {
        $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $english = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

        return str_replace($english, $persian, $string);
    }

    /**
     * تبدیل اعداد فارسی به انگلیسی
     */
    public static function toEnglishNumbers($string)
    {
        $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $english = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

        return str_replace($persian, $english, $string);
    }

    /**
     * تبدیل تاریخ به فرمت فارسی (میلادی)
     */
    public static function toPersianDate($date, $format = 'Y/m/d')
    {
        if (!$date) return '';

        // اگر Carbon object است
        if ($date instanceof Carbon) {
            return self::toPersianNumbers($date->format($format));
        }

        // اگر timestamp است
        if (is_numeric($date)) {
            return self::toPersianNumbers(date($format, $date));
        }

        // اگر string است
        if (is_string($date)) {
            $carbon = Carbon::parse($date);
            return self::toPersianNumbers($carbon->format($format));
        }

        return '';
    }

    /**
     * تبدیل تاریخ میلادی به شمسی (ساده)
     */
    private static function gregorianToPersian($gregorian)
    {
        // این یک تبدیل ساده است. برای دقت بیشتر از کتابخانه‌های تخصصی استفاده کنید
        $date = explode('-', $gregorian);
        $year = (int)$date[0];
        $month = (int)$date[1];
        $day = (int)$date[2];

        // تبدیل تقریبی (برای دقت بیشتر از کتابخانه‌های تخصصی استفاده کنید)
        $persianYear = $year - 621;
        $persianMonth = $month;
        $persianDay = $day;

        return sprintf('%04d/%02d/%02d', $persianYear, $persianMonth, $persianDay);
    }

    /**
     * فرمت کردن اعداد با جداکننده هزارگان
     */
    public static function formatNumber($number)
    {
        return self::toPersianNumbers(number_format($number));
    }

    /**
     * فرمت کردن پول
     */
    public static function formatCurrency($amount, $currency = 'تومان')
    {
        return self::formatNumber($amount) . ' ' . $currency;
    }

    /**
     * تبدیل اندازه فایل
     */
    public static function formatFileSize($bytes)
    {
        $units = ['بایت', 'کیلوبایت', 'مگابایت', 'گیگابایت'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        $bytes /= pow(1024, $pow);

        return self::toPersianNumbers(round($bytes, 2)) . ' ' . $units[$pow];
    }

    /**
     * تبدیل زمان به فرمت فارسی
     */
    public static function formatTime($timestamp)
    {
        if ($timestamp instanceof Carbon) {
            return self::toPersianNumbers($timestamp->format('H:i'));
        }

        $time = date('H:i', is_numeric($timestamp) ? $timestamp : strtotime($timestamp));
        return self::toPersianNumbers($time);
    }

    /**
     * تبدیل تاریخ و زمان کامل
     */
    public static function formatDateTime($date)
    {
        if (!$date) return '';

        if ($date instanceof Carbon) {
            $datePart = self::toPersianNumbers($date->format('Y/m/d'));
            $timePart = self::toPersianNumbers($date->format('H:i'));
            return $datePart . ' ' . $timePart;
        }

        $carbon = Carbon::parse($date);
        $datePart = self::toPersianNumbers($carbon->format('Y/m/d'));
        $timePart = self::toPersianNumbers($carbon->format('H:i'));

        return $datePart . ' ' . $timePart;
    }

    /**
     * تبدیل مدت زمان به فارسی
     */
    public static function formatDuration($seconds)
    {
        $hours = floor($seconds / 3600);
        $minutes = floor(($seconds % 3600) / 60);
        $secs = $seconds % 60;

        $parts = [];
        if ($hours > 0) {
            $parts[] = self::toPersianNumbers($hours) . ' ساعت';
        }
        if ($minutes > 0) {
            $parts[] = self::toPersianNumbers($minutes) . ' دقیقه';
        }
        if ($secs > 0 || empty($parts)) {
            $parts[] = self::toPersianNumbers($secs) . ' ثانیه';
        }

        return implode(' و ', $parts);
    }

    /**
     * فرمت تاریخ برای نمایش در UI
     */
    public static function formatDateForDisplay($date)
    {
        if (!$date) return '';

        if ($date instanceof Carbon) {
            return self::toPersianNumbers($date->format('Y/m/d'));
        }

        $carbon = Carbon::parse($date);
        return self::toPersianNumbers($carbon->format('Y/m/d'));
    }

    /**
     * فرمت تاریخ و زمان برای نمایش در UI
     */
    public static function formatDateTimeForDisplay($date)
    {
        if (!$date) return '';

        if ($date instanceof Carbon) {
            return self::toPersianNumbers($date->format('Y/m/d H:i'));
        }

        $carbon = Carbon::parse($date);
        return self::toPersianNumbers($carbon->format('Y/m/d H:i'));
    }
}
