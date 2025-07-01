<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrandLevel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'display_name',
        'description',
        'color',
        'icon',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * رابطه با برندها
     */
    public function brands()
    {
        return $this->hasMany(Brand::class);
    }

    /**
     * اسکوپ برای سطوح فعال
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
        return $query->orderBy('sort_order');
    }
}
