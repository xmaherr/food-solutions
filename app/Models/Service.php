<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasImageAttribute;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    use HasImageAttribute;

    protected $fillable = [
        'title_ar',
        'title_en',
        'icon',
        'short_description_ar',
        'short_description_en',
        'long_description_ar',
        'long_description_en',
        'points_ar',
        'points_en',
        'image',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'points_ar' => 'array',
        'points_en' => 'array',
        'is_active' => 'boolean',
    ];

    // ──────────────────────────────────────────────
    // Language-aware Accessors
    // ──────────────────────────────────────────────

    private function lang(): string
    {
        return app()->bound('current_language') ? app('current_language') : 'ar';
    }

    public function getTitleAttribute(): string
    {
        return $this->lang() === 'en'
            ? ($this->title_en ?? $this->title_ar)
            : ($this->title_ar ?? $this->title_en);
    }

    public function getShortDescriptionAttribute(): string
    {
        return $this->lang() === 'en'
            ? ($this->short_description_en ?? $this->short_description_ar)
            : ($this->short_description_ar ?? $this->short_description_en);
    }

    public function getLongDescriptionAttribute(): string
    {
        return $this->lang() === 'en'
            ? ($this->long_description_en ?? $this->long_description_ar)
            : ($this->long_description_ar ?? $this->long_description_en);
    }

    public function getPointsAttribute(): ?array
    {
        return $this->lang() === 'en'
            ? ($this->points_en ?? $this->points_ar)
            : ($this->points_ar ?? $this->points_en);
    }

    // ──────────────────────────────────────────────
    // Relationships
    // ──────────────────────────────────────────────

    public function consultations(): HasMany
    {
        return $this->hasMany(Consultation::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(ServiceReview::class);
    }
}
