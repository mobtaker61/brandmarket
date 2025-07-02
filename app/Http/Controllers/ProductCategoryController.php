<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCategory;
use Illuminate\Support\Str;
use Illuminate\Http\JsonResponse;

class ProductCategoryController extends Controller
{
    /**
     * نمایش لیست دسته‌ها
     */
    public function index()
    {
        $categories = ProductCategory::with('children')->whereNull('parent_id')->get();
        return view('categories.index', compact('categories'));
    }

    /**
     * نمایش فرم ایجاد دسته جدید
     */
    public function create()
    {
        $parentCategories = ProductCategory::whereNull('parent_id')->get();
        return view('categories.create', compact('parentCategories'));
    }

    /**
     * ذخیره دسته جدید
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:10',
            'color' => 'nullable|string|max:7',
            'parent_id' => 'nullable|exists:product_categories,id'
        ]);

        ProductCategory::create($request->all());

        return redirect()->route('categories.index')
            ->with('success', 'دسته با موفقیت ایجاد شد.');
    }

    /**
     * نمایش جزئیات دسته
     */
    public function show(ProductCategory $category)
    {
        $category->load(['children', 'parent']);
        $brands = $category->brands()->with(['country', 'level', 'owner'])
            ->latest()
            ->paginate(10);
        return view('categories.show', compact('category', 'brands'));
    }

    /**
     * نمایش فرم ویرایش دسته
     */
    public function edit(ProductCategory $category)
    {
        $parentCategories = ProductCategory::whereNull('parent_id')
            ->where('id', '!=', $category->id)
            ->get();
        return view('categories.edit', compact('category', 'parentCategories'));
    }

    /**
     * به‌روزرسانی دسته
     */
    public function update(Request $request, ProductCategory $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:10',
            'color' => 'nullable|string|max:7',
            'parent_id' => 'nullable|exists:product_categories,id'
        ]);

        $category->update($request->all());

        return redirect()->route('categories.show', $category)
            ->with('success', 'دسته با موفقیت به‌روزرسانی شد.');
    }

    /**
     * حذف دسته
     */
    public function destroy(ProductCategory $category)
    {
        // بررسی وجود زیرگروه‌ها
        if ($category->children()->count() > 0) {
            return back()->with('error', 'نمی‌توانید دسته‌ای که دارای زیرگروه است را حذف کنید.');
        }

        // بررسی وجود برندها
        if ($category->brands()->count() > 0) {
            return back()->with('error', 'نمی‌توانید دسته‌ای که دارای برند است را حذف کنید.');
        }

        $category->delete();

        return redirect()->route('categories.index')
            ->with('success', 'دسته با موفقیت حذف شد.');
    }

    /**
     * API: دریافت تمام دسته‌ها
     */
    public function getAll(): JsonResponse
    {
        $categories = ProductCategory::with('children')
            ->whereNull('parent_id')
            ->get()
            ->map(function ($category) {
                return [
                    'id' => $category->id,
                    'name' => $category->name,
                    'description' => $category->description,
                    'icon' => $category->icon,
                    'color' => $category->color,
                    'children' => $category->children->map(function ($child) {
                        return [
                            'id' => $child->id,
                            'name' => $child->name,
                            'description' => $child->description,
                            'icon' => $child->icon,
                            'color' => $child->color,
                            'brands_count' => $child->brands()->count()
                        ];
                    }),
                    'brands_count' => $category->brands()->count()
                ];
            });

        return response()->json($categories);
    }

    /**
     * API: دریافت زیرگروه‌های یک دسته
     */
    public function getChildren(ProductCategory $category): JsonResponse
    {
        $children = $category->children()->with('brands')->get()->map(function ($child) {
            return [
                'id' => $child->id,
                'name' => $child->name,
                'description' => $child->description,
                'icon' => $child->icon,
                'color' => $child->color,
                'brands_count' => $child->brands()->count(),
                'created_at' => $child->created_at->format('Y-m-d H:i:s')
            ];
        });

        return response()->json($children);
    }
}
