<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Brand;
use App\Models\Country;
use App\Models\ProductCategory;
use App\Models\BrandLevel;
use App\Models\User;

class BrandAIController extends Controller
{
    public function showForm()
    {
        $countries = Country::active()->ordered()->get();
        $categories = ProductCategory::with('children')->active()->ordered()->get();
        $brandLevels = BrandLevel::active()->ordered()->get();
        $users = User::with('userType')->get();
        return view('brands.ai-create', compact('countries', 'categories', 'brandLevels', 'users'));
    }

    public function fetchBrandInfo(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        $brandName = $request->input('name');
        $apiKey = 'AIzaSyB6XRcSvcvEqpXgBEujlZMHhjliKVJwR6w';
        $prompt = "لطفا اطلاعات زیر را درباره برند $brandName به صورت JSON و با فیلدهای زیر ارائه بده: {\"name\":\"\",\"country\":\"\",\"industry\":\"\",\"description\":\"\",\"logo\":\"\",\"website\":\"\",\"iran_market_presence\":\"official|unofficial|absent\"}. حضور برند در بازار ایران را فقط با یکی از این سه مقدار مشخص کن: official (نمایندگی رسمی)، unofficial (حضور غیررسمی)، absent (عدم حضور).";
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'x-goog-api-key' => $apiKey,
        ])->post('https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent', [
            'contents' => [
                ['parts' => [['text' => $prompt]]]
            ]
        ]);
        if ($response->successful()) {
            $fullResponse = $response->json();
            Log::info('Gemini API raw response', ['response' => $fullResponse]);
            $text = data_get($fullResponse, 'candidates.0.content.parts.0.text');
            if (!$text) {
                return response()->json([
                    'success' => false,
                    'message' => 'پاسخ نامعتبر از هوش مصنوعی: ' . json_encode($fullResponse, JSON_UNESCAPED_UNICODE)
                ]);
            }
            $text = preg_replace('/^```json|^```|```$/m', '', trim($text));
            $aiData = json_decode($text, true);
            // تطبیق کشور
            $country = null;
            if (!empty($aiData['country'])) {
                $country = Country::where(function($query) use ($aiData) {
                    $query->where('name', 'like', '%' . $aiData['country'] . '%')
                          ->orWhere('name_en', 'like', '%' . $aiData['country'] . '%');
                })->first();
            }
            $country_id = $country ? $country->id : null;
            // تطبیق دسته‌بندی/صنعت (ممکن است چند مقدار باشد)
            $category_ids = [];
            if (!empty($aiData['industry'])) {
                $industries = array_map('trim', explode(',', $aiData['industry']));
                foreach ($industries as $industry) {
                    // ابتدا بر اساس نام دسته‌بندی جستجو (شامل زیردسته‌ها)
                    $cat = ProductCategory::where('name', 'like', '%' . $industry . '%')->first();

                    // اگر پیدا نشد، بر اساس کلمات کلیدی صنعت جستجو (شامل زیردسته‌ها)
                    if (!$cat) {
                        $cat = ProductCategory::whereJsonContains('industry_keywords', strtolower($industry))->first();
                    }

                    // اگر هنوز پیدا نشد، بر اساس کلمات کلیدی مشابه جستجو (شامل زیردسته‌ها)
                    if (!$cat) {
                        $cat = ProductCategory::where(function($query) use ($industry) {
                            $query->whereJsonLength('industry_keywords', '>', 0)
                                  ->whereRaw('JSON_SEARCH(LOWER(industry_keywords), "one", ?, null, "$[*]")', ['%' . strtolower($industry) . '%']);
                        })->first();
                    }

                    if ($cat && !in_array($cat->id, $category_ids)) {
                        $category_ids[] = $cat->id;
                    }
                }
            }
            // آماده‌سازی داده برای فرم
            $result = [
                'name' => $aiData['name'] ?? '',
                'country_id' => $country_id,
                'country_name' => $aiData['country'] ?? '',
                'brand_status' => 'listed',
                'iran_market_presence' => $aiData['iran_market_presence'] ?? '',
                'is_active' => true,
                'description' => $aiData['description'] ?? '',
                'category_ids' => $category_ids,
                'industry' => $aiData['industry'] ?? '',
                'website' => $aiData['website'] ?? '',
                'logo' => $aiData['logo'] ?? '',
            ];
            return response()->json(['success' => true, 'data' => $result]);
        } else {
            $errorBody = $response->body();
            Log::error('Gemini API error', ['response' => $errorBody]);
            return response()->json([
                'success' => false,
                'message' => 'خطا در ارتباط با هوش مصنوعی: ' . $errorBody
            ]);
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'company_name' => 'nullable|string|max:255',
                'country_id' => 'required|exists:countries,id',
                'brand_level_id' => 'nullable|exists:brand_levels,id',
                'owner_id' => 'nullable|exists:users,id',
                'brand_status' => 'required|in:listed,started,waiting,rejected,registered',
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
                'notes' => 'nullable|string',
            ]);
            $brand = Brand::create($validated);
            if (!empty($validated['category_ids'])) {
                $categoryData = [];
                foreach ($validated['category_ids'] as $index => $categoryId) {
                    $categoryData[$categoryId] = ['is_primary' => $index === 0];
                }
                $brand->categories()->attach($categoryData);
            }
            return response()->json(['success' => true, 'redirect' => route('brands.show', $brand)]);
        } catch (\Exception $e) {
            Log::error('BrandAIController store error', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return response()->json([
                'success' => false,
                'message' => 'خطای سرور: ' . $e->getMessage()
            ], 500);
        }
    }
}
