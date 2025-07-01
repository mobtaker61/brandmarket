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

// API Routes برای Alpine.js
Route::prefix('api')->group(function () {
    Route::get('/stats', [AnalyticsController::class, 'getStats']);
    Route::get('/brands/recent', [BrandController::class, 'getRecent']);
    Route::get('/categories', [ProductCategoryController::class, 'getAll']);
    Route::get('/categories/{category}/children', [ProductCategoryController::class, 'getChildren']);
    Route::get('/countries', [BrandController::class, 'getCountries']);
});

Route::get('/test', function() { return 'test ok'; });
