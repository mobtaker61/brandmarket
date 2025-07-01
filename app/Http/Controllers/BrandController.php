<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\ProductCategory;
use App\Models\Country;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class BrandController extends Controller
{
    /**
     * نمایش لیست برندها
     */
    public function index(Request $request): View
    {
        $query = Brand::with(['categories', 'country']);

        // جستجو
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('company_name', 'like', "%{$search}%")
                  ->orWhereHas('country', function ($countryQuery) use ($search) {
                      $countryQuery->where('name', 'like', "%{$search}%");
                  });
            });
        }

        // فیلتر کشور
        if ($request->filled('country')) {
            $query->where('country_id', $request->country);
        }

        // فیلتر دسته محصول
        if ($request->filled('category')) {
            $query->whereHas('categories', function ($categoryQuery) use ($request) {
                $categoryQuery->where('product_categories.id', $request->category);
            });
        }

        // فیلتر حضور در ایران
        if ($request->filled('iran_presence')) {
            $query->where('iran_market_presence', $request->iran_presence);
        }

        // فیلتر وضعیت برند
        if ($request->filled('brand_status')) {
            $query->where('brand_status', $request->brand_status);
        }

        // فیلتر فعال/غیرفعال
        if ($request->filled('is_active')) {
            $query->where('is_active', $request->is_active);
        }

        // مرتب‌سازی
        switch ($request->get('sort', 'latest')) {
            case 'oldest':
                $query->oldest();
                break;
            case 'name_asc':
                $query->orderBy('name', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('name', 'desc');
                break;
            default:
                $query->latest();
                break;
        }

        $perPage = $request->get('per_page', 20);
        $brands = $query->paginate($perPage)->withQueryString();

        // داده‌های مورد نیاز برای فیلترها
        $countries = Country::active()->ordered()->get();
        $categories = ProductCategory::active()->ordered()->get();

        return view('brands.index', compact('brands', 'countries', 'categories'));
    }

    /**
     * نمایش فرم ایجاد برند جدید
     */
    public function create(): View
    {
        $countries = Country::active()->ordered()->get();
        $categories = ProductCategory::active()->ordered()->get();

        return view('brands.create', compact('countries', 'categories'));
    }

    /**
     * ذخیره برند جدید
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:brands',
            'company_name' => 'required|string|max:255',
            'country_id' => 'required|exists:countries,id',
            'brand_status' => 'required|in:active,inactive,pending',
            'iran_market_presence' => 'required|in:official,unofficial,absent',
            'is_active' => 'boolean',
            'description' => 'nullable|string',
            'category_ids' => 'array',
            'category_ids.*' => 'exists:product_categories,id',
            'website' => 'nullable|url',
            'instagram' => 'nullable|string|max:255',
            'telegram' => 'nullable|string|max:255',
            'linkedin' => 'nullable|string|max:255',
            'logo' => 'nullable|url',
            'logo_file' => 'nullable|image|max:2048',
            'notes' => 'nullable|string',
        ]);

        // منطق آپلود لوگو
        if ($request->hasFile('logo_file')) {
            $file = $request->file('logo_file');
            $path = $file->store('brands/logos', 'public');
            $validated['logo'] = asset('storage/' . $path);
        }

        $brand = Brand::create($validated);

        // اضافه کردن دسته‌ها
        if (!empty($validated['category_ids'])) {
            $categoryData = [];
            foreach ($validated['category_ids'] as $index => $categoryId) {
                $categoryData[$categoryId] = ['is_primary' => $index === 0];
            }
            $brand->categories()->attach($categoryData);
        }

        return redirect()->route('brands.show', $brand)
            ->with('success', 'برند با موفقیت ایجاد شد.');
    }

    /**
     * نمایش جزئیات برند
     */
    public function show(Brand $brand): View
    {
        $brand->load(['categories', 'country']);
        return view('brands.show', compact('brand'));
    }

    /**
     * نمایش فرم ویرایش برند
     */
    public function edit(Brand $brand): View
    {
        $brand->load(['categories', 'country']);
        $countries = Country::active()->ordered()->get();
        $categories = ProductCategory::active()->ordered()->get();

        return view('brands.edit', compact('brand', 'countries', 'categories'));
    }

    /**
     * به‌روزرسانی برند
     */
    public function update(Request $request, Brand $brand): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:brands,name,' . $brand->id,
            'company_name' => 'required|string|max:255',
            'country_id' => 'required|exists:countries,id',
            'brand_status' => 'required|in:active,inactive,pending',
            'iran_market_presence' => 'required|in:official,unofficial,absent',
            'is_active' => 'boolean',
            'description' => 'nullable|string',
            'category_ids' => 'array',
            'category_ids.*' => 'exists:product_categories,id',
            'website' => 'nullable|url',
            'instagram' => 'nullable|string|max:255',
            'telegram' => 'nullable|string|max:255',
            'linkedin' => 'nullable|string|max:255',
            'logo' => 'nullable|url',
            'logo_file' => 'nullable|image|max:2048',
            'notes' => 'nullable|string',
        ]);

        // منطق آپلود لوگو
        if ($request->hasFile('logo_file')) {
            $file = $request->file('logo_file');
            $path = $file->store('brands/logos', 'public');
            $validated['logo'] = asset('storage/' . $path);
        }

        $brand->update($validated);

        // به‌روزرسانی دسته‌ها
        $categoryData = [];
        if (!empty($validated['category_ids'])) {
            foreach ($validated['category_ids'] as $index => $categoryId) {
                $categoryData[$categoryId] = ['is_primary' => $index === 0];
            }
        }
        $brand->categories()->sync($categoryData);

        return redirect()->route('brands.show', $brand)
            ->with('success', 'برند با موفقیت به‌روزرسانی شد.');
    }

    /**
     * حذف برند
     */
    public function destroy(Brand $brand): RedirectResponse
    {
        $brand->categories()->detach();
        $brand->delete();

        return redirect()->route('brands.index')
            ->with('success', 'برند با موفقیت حذف شد.');
    }

    /**
     * نمایش تحلیل‌های برند
     */
    public function analytics(Brand $brand)
    {
        return view('brands.analytics', compact('brand'));
    }

    /**
     * API: دریافت برندهای اخیر
     */
    public function getRecent(): JsonResponse
    {
        $brands = Brand::with(['categories', 'country'])
            ->latest()
            ->limit(10)
            ->get()
            ->map(function ($brand) {
                return [
                    'id' => $brand->id,
                    'name' => $brand->name,
                    'company_name' => $brand->company_name,
                    'country' => $brand->country ? $brand->country->name : 'نامشخص',
                    'country_id' => $brand->country_id,
                    'country_flag' => $brand->country ? $brand->country->flag : '',
                    'categories' => $brand->categories->pluck('name')->toArray(),
                    'brand_status' => $brand->brand_status,
                    'iran_market_presence' => $brand->iran_market_presence,
                    'is_active' => $brand->is_active,
                    'lastUpdated' => $brand->updated_at->format('Y-m-d'),
                    'logo' => $brand->logo ?? 'https://via.placeholder.com/40'
                ];
            });

        return response()->json($brands);
    }

    /**
     * API: دریافت لیست کشورها
     */
    public function getCountries(): JsonResponse
    {
        $countries = Country::active()->ordered()->get()->map(function ($country) {
            return [
                'id' => $country->id,
                'name' => $country->name,
                'name_en' => $country->name_en,
                'code' => $country->code,
                'flag' => $country->flag
            ];
        });

        return response()->json($countries);
    }

    /**
     * Export برندها به CSV
     */
    public function export(Request $request): \Symfony\Component\HttpFoundation\Response
    {
        $query = Brand::with(['categories', 'country']);

        // اعمال همان فیلترهای index
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('company_name', 'like', "%{$search}%")
                  ->orWhereHas('country', function ($countryQuery) use ($search) {
                      $countryQuery->where('name', 'like', "%{$search}%");
                  });
            });
        }

        if ($request->filled('country')) {
            $query->where('country_id', $request->country);
        }

        if ($request->filled('category')) {
            $query->whereHas('categories', function ($categoryQuery) use ($request) {
                $categoryQuery->where('product_categories.id', $request->category);
            });
        }

        if ($request->filled('iran_presence')) {
            $query->where('iran_market_presence', $request->iran_presence);
        }

        if ($request->filled('brand_status')) {
            $query->where('brand_status', $request->brand_status);
        }

        if ($request->filled('is_active')) {
            $query->where('is_active', $request->is_active);
        }

        $brands = $query->latest()->get();

        $filename = 'brands_' . now()->format('Y-m-d_H-i-s') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($brands) {
            $file = fopen('php://output', 'w');

            // اضافه کردن BOM برای UTF-8
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));

            // هدر CSV
            fputcsv($file, [
                'نام برند',
                'نام شرکت',
                'کشور',
                'دسته‌های محصولات',
                'وضعیت برند',
                'حضور در ایران',
                'فعال',
                'وبسایت',
                'اینستاگرام',
                'تلگرام',
                'لینکدین',
                'توضیحات',
                'یادداشت‌ها',
                'تاریخ ایجاد',
                'تاریخ به‌روزرسانی'
            ]);

            // داده‌ها
            foreach ($brands as $brand) {
                fputcsv($file, [
                    $brand->name,
                    $brand->company_name,
                    $brand->country->name ?? 'نامشخص',
                    $brand->categories->pluck('name')->implode(', '),
                    $brand->status_text,
                    $brand->iran_presence_text,
                    $brand->is_active ? 'بله' : 'خیر',
                    $brand->website,
                    $brand->instagram,
                    $brand->telegram,
                    $brand->linkedin,
                    $brand->description,
                    $brand->notes,
                    $brand->created_at->format('Y-m-d H:i:s'),
                    $brand->updated_at->format('Y-m-d H:i:s')
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
