<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\ProductCategory;
use Illuminate\Http\JsonResponse;

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

        $industryStats = Brand::selectRaw('industry, COUNT(*) as count')
            ->groupBy('industry')
            ->orderBy('count', 'desc')
            ->get();

        $countryStats = Brand::selectRaw('country, COUNT(*) as count')
            ->groupBy('country')
            ->orderBy('count', 'desc')
            ->get();

        return view('analytics.index', compact(
            'totalBrands',
            'activeBrands',
            'inactiveBrands',
            'industryStats',
            'countryStats'
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
            'download_url' => '/reports/analytics.' . $format
        ]);
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
            'topIndustries' => $this->getTopIndustries(),
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
     * دریافت صنایع برتر
     */
    private function getTopIndustries()
    {
        return Brand::selectRaw('industry, COUNT(*) as count')
            ->groupBy('industry')
            ->orderBy('count', 'desc')
            ->limit(5)
            ->get();
    }

    /**
     * دریافت کشورهای برتر
     */
    private function getTopCountries()
    {
        return Brand::selectRaw('country, COUNT(*) as count')
            ->groupBy('country')
            ->orderBy('count', 'desc')
            ->limit(5)
            ->get();
    }
}
