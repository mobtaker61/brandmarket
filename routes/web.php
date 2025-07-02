<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\BrandAIController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// صفحه اصلی
Route::get('/', function () {
    return view('home');
})->name('home');

// دسته‌های محصولات
Route::get('/categories', [ProductCategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/create', [ProductCategoryController::class, 'create'])->name('categories.create');
Route::post('/categories', [ProductCategoryController::class, 'store'])->name('categories.store');
Route::get('/categories/{category}', [ProductCategoryController::class, 'show'])->name('categories.show');
Route::get('/categories/{category}/edit', [ProductCategoryController::class, 'edit'])->name('categories.edit');
Route::put('/categories/{category}', [ProductCategoryController::class, 'update'])->name('categories.update');
Route::delete('/categories/{category}', [ProductCategoryController::class, 'destroy'])->name('categories.destroy');

// برندها
Route::get('/brands', [BrandController::class, 'index'])->name('brands.index');
Route::get('/brands/create', [BrandController::class, 'create'])->name('brands.create');
Route::post('/brands', [BrandController::class, 'store'])->name('brands.store');
Route::get('/brands/export', [BrandController::class, 'export'])->name('brands.export');
Route::get('/brands/ai-create', [BrandAIController::class, 'showForm'])->name('brands.ai_create');
Route::post('/brands/ai-fetch', [BrandAIController::class, 'fetchBrandInfo'])->name('brands.ai_fetch');
Route::post('/brands/ai-store', [BrandAIController::class, 'store'])->name('brands.ai_store');
Route::get('/brands/{brand}', [BrandController::class, 'show'])->name('brands.show');
Route::get('/brands/{brand}/edit', [BrandController::class, 'edit'])->name('brands.edit');
Route::put('/brands/{brand}', [BrandController::class, 'update'])->name('brands.update');
Route::delete('/brands/{brand}', [BrandController::class, 'destroy'])->name('brands.destroy');

// تحلیل‌ها
Route::get('/analytics', [AnalyticsController::class, 'index'])->name('analytics');
Route::get('/analytics/export', [AnalyticsController::class, 'export'])->name('analytics.export');
Route::get('/reports/analytics.{format}', [AnalyticsController::class, 'downloadReport'])->name('analytics.download');

// API Routes
Route::get('/api/stats', function () {
    $totalBrands = \App\Models\Brand::count();
    $activeBrands = \App\Models\Brand::where('is_active', true)->count();

    // محاسبه رشد ماهانه
    $lastMonth = \App\Models\Brand::where('created_at', '>=', now()->subMonth())->count();
    $previousMonth = \App\Models\Brand::whereBetween('created_at', [now()->subMonths(2), now()->subMonth()])->count();
    $monthlyGrowth = $previousMonth > 0 ? round((($lastMonth - $previousMonth) / $previousMonth) * 100, 1) : 0;

    return response()->json([
        'totalBrands' => $totalBrands,
        'activeBrands' => $activeBrands,
        'monthlyGrowth' => $monthlyGrowth
    ]);
});

Route::get('/api/categories', function () {
    $categories = \App\Models\ProductCategory::with('children')->get();
    return response()->json($categories);
});

Route::get('/api/brands/recent', function () {
    $brands = \App\Models\Brand::with(['country', 'category', 'brandLevel', 'owner'])
        ->latest()
        ->take(10)
        ->get()
        ->map(function ($brand) {
            return [
                'id' => $brand->id,
                'name' => $brand->name,
                'description' => $brand->description,
                'logo' => $brand->logo,
                'country_name' => $brand->country ? $brand->country->name : 'نامشخص',
                'category_name' => $brand->category ? $brand->category->name : 'نامشخص',
                'level_name' => $brand->brandLevel ? $brand->brandLevel->name : 'نامشخص',
                'level_icon' => $brand->brandLevel ? $brand->brandLevel->icon : '',
                'level_color' => $brand->brandLevel ? $brand->brandLevel->color : '#000',
                'owner_name' => $brand->owner ? $brand->owner->name : 'نامشخص',
                'is_active' => $brand->is_active,
                'created_at' => $brand->created_at->format('Y-m-d H:i:s')
            ];
        });

    return response()->json($brands);
});

Route::get('/api/brands/check-name', function (\Illuminate\Http\Request $request) {
    $name = $request->query('name');
    $exists = \App\Models\Brand::where('name', $name)->exists();
    return response()->json(['exists' => $exists]);
});

Route::get('/test', function() { return 'test ok'; });
