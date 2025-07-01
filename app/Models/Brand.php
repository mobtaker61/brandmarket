<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'company_name',
        'country_id',
        'brand_level_id',
        'owner_id',
        'description',
        'website',
        'instagram',
        'telegram',
        'linkedin',
        'logo',
        'brand_status',
        'iran_market_presence',
        'is_active',
        'notes'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * رابطه با کشور
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * رابطه با سطح برند
     */
    public function level()
    {
        return $this->belongsTo(BrandLevel::class, 'brand_level_id');
    }

    /**
     * رابطه با مالک برند
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    /**
     * رابطه چند به چند با دسته‌های محصول
     */
    public function categories()
    {
        return $this->belongsToMany(ProductCategory::class, 'brand_category')
                    ->withPivot('is_primary')
                    ->withTimestamps();
    }

    /**
     * رابطه با دسته اصلی (دسته‌ای که is_primary = true است)
     */
    public function primaryCategory()
    {
        return $this->belongsToMany(ProductCategory::class, 'brand_category')
                    ->wherePivot('is_primary', true)
                    ->withTimestamps();
    }

    /**
     * رابطه با تحلیل‌ها
     */
    // public function analytics()
    // {
    //     return $this->hasMany(BrandAnalytics::class);
    // }

    /**
     * رابطه با گزارش‌ها
     */
    // public function reports()
    // {
    //     return $this->hasMany(BrandReport::class);
    // }

    /**
     * Accessor برای نمایش متن وضعیت برند
     */
    public function getStatusTextAttribute(): string
    {
        return match($this->brand_status) {
            'listed' => 'لیست شده',
            'started' => 'شروع شده',
            'waiting' => 'در انتظار',
            'rejected' => 'رد شده',
            'registered' => 'ثبت رسمی',
            default => 'نامشخص'
        };
    }

    /**
     * Accessor برای کلاس CSS وضعیت برند
     */
    public function getStatusClassAttribute(): string
    {
        return match($this->brand_status) {
            'listed' => 'bg-blue-100 text-blue-800',
            'started' => 'bg-yellow-100 text-yellow-800',
            'waiting' => 'bg-orange-100 text-orange-800',
            'rejected' => 'bg-red-100 text-red-800',
            'registered' => 'bg-green-100 text-green-800',
            default => 'bg-gray-100 text-gray-800'
        };
    }

    /**
     * Accessor برای نمایش متن حضور در ایران
     */
    public function getIranPresenceTextAttribute(): string
    {
        return match($this->iran_market_presence) {
            'official' => 'رسمی',
            'unofficial' => 'غیررسمی',
            'absent' => 'غایب',
            default => 'نامشخص'
        };
    }

    /**
     * Accessor برای کلاس CSS حضور در ایران
     */
    public function getIranPresenceClassAttribute(): string
    {
        return match($this->iran_market_presence) {
            'official' => 'bg-green-100 text-green-800',
            'unofficial' => 'bg-yellow-100 text-yellow-800',
            'absent' => 'bg-red-100 text-red-800',
            default => 'bg-gray-100 text-gray-800'
        };
    }

    /**
     * Scope برای برندهای فعال
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * اسکوپ برای برندهای غیرفعال
     */
    public function scopeInactive($query)
    {
        return $query->where('is_active', false);
    }

    /**
     * Scope برای برندهای با حضور رسمی در ایران
     */
    public function scopeOfficialInIran($query)
    {
        return $query->where('iran_market_presence', 'official');
    }

    /**
     * Scope برای برندهای با حضور غیررسمی در ایران
     */
    public function scopeUnofficialInIran($query)
    {
        return $query->where('iran_market_presence', 'unofficial');
    }

    /**
     * Scope برای برندهای غایب از ایران
     */
    public function scopeAbsentFromIran($query)
    {
        return $query->where('iran_market_presence', 'absent');
    }

    /**
     * اسکوپ برای جستجو در نام برند و شرکت
     */
    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', "%{$search}%")
                    ->orWhere('company_name', 'like', "%{$search}%")
                    ->orWhereHas('country', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
    }

    /**
     * اسکوپ برای فیلتر بر اساس دسته
     */
    public function scopeByCategory($query, $categoryId)
    {
        return $query->whereHas('categories', function ($q) use ($categoryId) {
            $q->where('product_category_id', $categoryId);
        });
    }

    /**
     * اسکوپ برای فیلتر بر اساس وضعیت حضور در ایران
     */
    public function scopeByIranPresence($query, $presence)
    {
        return $query->where('iran_market_presence', $presence);
    }

    /**
     * اسکوپ برای فیلتر بر اساس کشور
     */
    public function scopeByCountry($query, $countryId)
    {
        return $query->where('country_id', $countryId);
    }
}
