<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ProductCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'icon',
        'color',
        'parent_id',
        'sort_order',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * رابطه با دسته والد
     */
    public function parent()
    {
        return $this->belongsTo(ProductCategory::class, 'parent_id');
    }

    /**
     * رابطه با زیردسته‌ها
     */
    public function children()
    {
        return $this->hasMany(ProductCategory::class, 'parent_id')->orderBy('sort_order');
    }

    /**
     * رابطه با تمام زیردسته‌ها (recursive)
     */
    public function allChildren()
    {
        return $this->children()->with('allChildren');
    }

    /**
     * رابطه با برندها (چند به چند)
     */
    public function brands()
    {
        return $this->belongsToMany(Brand::class, 'brand_category')
                    ->withPivot('is_primary')
                    ->withTimestamps();
    }

    /**
     * رابطه با برندهایی که این دسته دسته اصلی آنهاست
     */
    public function primaryBrands()
    {
        return $this->belongsToMany(Brand::class, 'brand_category')
                    ->wherePivot('is_primary', true)
                    ->withTimestamps();
    }

    /**
     * اسکوپ برای دسته‌های اصلی (بدون والد)
     */
    public function scopeMainCategories($query)
    {
        return $query->whereNull('parent_id');
    }

    /**
     * اسکوپ برای دسته‌های فعال
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * اسکوپ برای مرتب‌سازی
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }

    /**
     * تولید خودکار slug
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });

        static::updating(function ($category) {
            if ($category->isDirty('name') && empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });
    }

    /**
     * بررسی اینکه آیا دسته اصلی است
     */
    public function isMainCategory()
    {
        return is_null($this->parent_id);
    }

    /**
     * بررسی اینکه آیا زیردسته دارد
     */
    public function hasChildren()
    {
        return $this->children()->count() > 0;
    }

    /**
     * دریافت مسیر کامل دسته
     */
    public function getFullPathAttribute()
    {
        $path = [$this->name];
        $parent = $this->parent;

        while ($parent) {
            array_unshift($path, $parent->name);
            $parent = $parent->parent;
        }

        return implode(' > ', $path);
    }

    /**
     * دریافت تعداد کل برندها در این دسته و زیردسته‌ها
     */
    public function getTotalBrandsCountAttribute()
    {
        $count = $this->brands()->count();

        foreach ($this->children as $child) {
            $count += $child->total_brands_count;
        }

        return $count;
    }
}
