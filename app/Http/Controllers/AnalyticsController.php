<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\ProductCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    /**
     * نمایش صفحه تحلیل‌ها
     */
    public function index()
    {
        $totalBrands = Brand::count();
        $activeBrands = Brand::active()->count();
        $inactiveBrands = Brand::inactive()->count();

        // آمار دسته‌بندی‌ها بر اساس جدول واسط brand_category
        $categoryStats = DB::table('brand_category')
            ->select('product_category_id', DB::raw('COUNT(brand_id) as count'))
            ->groupBy('product_category_id')
            ->orderByDesc('count')
            ->get()
            ->map(function ($item) {
                $category = ProductCategory::find($item->product_category_id);
                return [
                    'name' => $category ? $category->name : 'نامشخص',
                    'count' => $item->count
                ];
            });

        // آمار کشورها
        $countryStats = Brand::with('country')
            ->selectRaw('country_id, COUNT(*) as count')
            ->groupBy('country_id')
            ->orderBy('count', 'desc')
            ->get()
            ->map(function ($item) {
                return [
                    'name' => $item->country ? $item->country->name : 'نامشخص',
                    'count' => $item->count
                ];
            });

        // آمار وضعیت برندها
        $statusStats = Brand::select('brand_status', DB::raw('COUNT(*) as count'))
            ->groupBy('brand_status')
            ->orderByDesc('count')
            ->get()
            ->map(function ($item) {
                $statusTexts = [
                    'listed' => 'لیست شده',
                    'started' => 'شروع شده',
                    'waiting' => 'در انتظار',
                    'rejected' => 'رد شده',
                    'registered' => 'ثبت رسمی',
                ];
                return [
                    'status' => $item->brand_status,
                    'name' => $statusTexts[$item->brand_status] ?? $item->brand_status,
                    'count' => $item->count
                ];
            });

        return view('analytics.index', compact(
            'totalBrands',
            'activeBrands',
            'inactiveBrands',
            'categoryStats',
            'countryStats',
            'statusStats'
        ));
    }

    /**
     * خروجی گزارش تحلیل‌ها
     */
    public function export(Request $request)
    {
        $format = $request->get('format', 'pdf');

        // منطق خروجی گزارش
        return response()->json([
            'message' => 'گزارش با موفقیت تولید شد',
            'download_url' => route('analytics.download', ['format' => $format])
        ]);
    }

    /**
     * دانلود گزارش تحلیل‌ها
     */
    public function downloadReport(Request $request, $format)
    {
        // بررسی فرمت مجاز
        $allowedFormats = ['pdf', 'excel', 'csv'];
        if (!in_array($format, $allowedFormats)) {
            abort(404, 'فرمت گزارش پشتیبانی نمی‌شود');
        }

        // جمع‌آوری داده‌ها
        $data = $this->getReportData();

        // تولید فایل بر اساس فرمت
        switch ($format) {
            case 'csv':
                return $this->generateCsvReport($data);
            case 'excel':
                return $this->generateExcelReport($data);
            case 'pdf':
                return $this->generatePdfReport($data);
            default:
                abort(404, 'فرمت گزارش پشتیبانی نمی‌شود');
        }
    }

    /**
     * جمع‌آوری داده‌های گزارش
     */
    private function getReportData()
    {
        $totalBrands = Brand::count();
        $activeBrands = Brand::active()->count();
        $inactiveBrands = Brand::inactive()->count();

        // آمار دسته‌بندی‌ها
        $categoryStats = DB::table('brand_category')
            ->select('product_category_id', DB::raw('COUNT(brand_id) as count'))
            ->groupBy('product_category_id')
            ->orderByDesc('count')
            ->get()
            ->map(function ($item) {
                $category = ProductCategory::find($item->product_category_id);
                return [
                    'name' => $category ? $category->name : 'نامشخص',
                    'count' => $item->count
                ];
            });

        // آمار کشورها
        $countryStats = Brand::with('country')
            ->selectRaw('country_id, COUNT(*) as count')
            ->groupBy('country_id')
            ->orderBy('count', 'desc')
            ->get()
            ->map(function ($item) {
                return [
                    'name' => $item->country ? $item->country->name : 'نامشخص',
                    'count' => $item->count
                ];
            });

        // آمار وضعیت برندها
        $statusStats = Brand::select('brand_status', DB::raw('COUNT(*) as count'))
            ->groupBy('brand_status')
            ->orderByDesc('count')
            ->get()
            ->map(function ($item) {
                $statusTexts = [
                    'listed' => 'لیست شده',
                    'started' => 'شروع شده',
                    'waiting' => 'در انتظار',
                    'rejected' => 'رد شده',
                    'registered' => 'ثبت رسمی',
                ];
                return [
                    'status' => $item->brand_status,
                    'name' => $statusTexts[$item->brand_status] ?? $item->brand_status,
                    'count' => $item->count
                ];
            });

        return [
            'totalBrands' => $totalBrands,
            'activeBrands' => $activeBrands,
            'inactiveBrands' => $inactiveBrands,
            'categoryStats' => $categoryStats,
            'countryStats' => $countryStats,
            'statusStats' => $statusStats,
            'generatedAt' => now()->format('Y-m-d H:i:s')
        ];
    }

    /**
     * تولید گزارش CSV
     */
    private function generateCsvReport($data)
    {
        $filename = 'analytics_report_' . now()->format('Y-m-d_H-i-s') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($data) {
            $file = fopen('php://output', 'w');

            // اضافه کردن BOM برای پشتیبانی از فارسی
            fwrite($file, "\xEF\xBB\xBF");

            // هدر گزارش
            fputcsv($file, ['گزارش تحلیل برندها']);
            fputcsv($file, ['تاریخ تولید: ' . $data['generatedAt']]);
            fputcsv($file, []);

            // آمار کلی
            fputcsv($file, ['آمار کلی']);
            fputcsv($file, ['کل برندها', $data['totalBrands']]);
            fputcsv($file, ['برندهای فعال', $data['activeBrands']]);
            fputcsv($file, ['برندهای غیرفعال', $data['inactiveBrands']]);
            fputcsv($file, []);

            // آمار دسته‌بندی‌ها
            fputcsv($file, ['آمار دسته‌بندی‌ها']);
            fputcsv($file, ['نام دسته', 'تعداد برند']);
            foreach ($data['categoryStats'] as $category) {
                fputcsv($file, [$category['name'], $category['count']]);
            }
            fputcsv($file, []);

            // آمار کشورها
            fputcsv($file, ['آمار کشورها']);
            fputcsv($file, ['نام کشور', 'تعداد برند']);
            foreach ($data['countryStats'] as $country) {
                fputcsv($file, [$country['name'], $country['count']]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * تولید گزارش Excel (فعلاً CSV با پسوند xlsx)
     */
    private function generateExcelReport($data)
    {
        // فعلاً همان CSV را با پسوند xlsx برمی‌گردانیم
        // برای Excel واقعی نیاز به پکیج Maatwebsite/Excel داریم
        return $this->generateCsvReport($data);
    }

    /**
     * تولید گزارش PDF (فعلاً HTML)
     */
    private function generatePdfReport($data)
    {
        // فعلاً HTML برمی‌گردانیم
        // برای PDF واقعی نیاز به پکیج DomPDF داریم
        $html = view('analytics.report', compact('data'))->render();

        return response($html)
            ->header('Content-Type', 'text/html; charset=UTF-8')
            ->header('Content-Disposition', 'inline; filename="analytics_report.html"');
    }

    /**
     * API: دریافت آمار کلی
     */
    public function getStats(): JsonResponse
    {
        $stats = [
            'totalBrands' => Brand::count(),
            'activeBrands' => Brand::active()->count(),
            'inactiveBrands' => Brand::inactive()->count(),
            'monthlyGrowth' => $this->calculateMonthlyGrowth(),
            'topCategories' => $this->getTopCategories(),
            'topCountries' => $this->getTopCountries()
        ];

        return response()->json($stats);
    }

    /**
     * محاسبه رشد ماهانه
     */
    private function calculateMonthlyGrowth()
    {
        $currentMonth = Brand::whereMonth('created_at', now()->month)->count();
        $lastMonth = Brand::whereMonth('created_at', now()->subMonth()->month)->count();

        if ($lastMonth == 0) {
            return $currentMonth > 0 ? 100 : 0;
        }

        return round((($currentMonth - $lastMonth) / $lastMonth) * 100, 2);
    }

    /**
     * دریافت دسته‌بندی‌های برتر (many-to-many)
     */
    private function getTopCategories()
    {
        return DB::table('brand_category')
            ->select('product_category_id', DB::raw('COUNT(brand_id) as count'))
            ->groupBy('product_category_id')
            ->orderByDesc('count')
            ->limit(5)
            ->get()
            ->map(function ($item) {
                $category = ProductCategory::find($item->product_category_id);
                return [
                    'name' => $category ? $category->name : 'نامشخص',
                    'count' => $item->count
                ];
            });
    }

    /**
     * دریافت کشورهای برتر
     */
    private function getTopCountries()
    {
        return Brand::with('country')
            ->selectRaw('country_id, COUNT(*) as count')
            ->groupBy('country_id')
            ->orderBy('count', 'desc')
            ->limit(5)
            ->get()
            ->map(function ($item) {
                return [
                    'name' => $item->country ? $item->country->name : 'نامشخص',
                    'count' => $item->count
                ];
            });
    }
}
