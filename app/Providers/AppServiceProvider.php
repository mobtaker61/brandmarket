<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use App\Helpers\PersianHelper;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Blade directive برای اعداد فارسی
        Blade::directive('persian', function ($expression) {
            return "<?php echo App\Helpers\PersianHelper::toPersianNumbers($expression); ?>";
        });

        // Blade directive برای فرمت اعداد
        Blade::directive('formatNumber', function ($expression) {
            return "<?php echo App\Helpers\PersianHelper::formatNumber($expression); ?>";
        });

        // Blade directive برای تاریخ میلادی فارسی
        Blade::directive('persianDate', function ($expression) {
            return "<?php echo App\Helpers\PersianHelper::formatDateForDisplay($expression); ?>";
        });

        // Blade directive برای تاریخ و زمان میلادی فارسی
        Blade::directive('persianDateTime', function ($expression) {
            return "<?php echo App\Helpers\PersianHelper::formatDateTimeForDisplay($expression); ?>";
        });

        // Blade directive برای پول
        Blade::directive('currency', function ($expression) {
            return "<?php echo App\Helpers\PersianHelper::formatCurrency($expression); ?>";
        });
    }
}
