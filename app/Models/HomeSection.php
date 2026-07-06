<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasImageAttribute;

class HomeSection extends Model
{
    use HasImageAttribute;

    protected $fillable = [
        'image',
        'title_ar',
        'title_en',
        'subtitle_ar',
        'subtitle_en',
        'description_ar',
        'description_en',
        'sort_order',
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

    public function getSubtitleAttribute(): string
    {
        return $this->lang() === 'en'
            ? ($this->subtitle_en ?? $this->subtitle_ar)
            : ($this->subtitle_ar ?? $this->subtitle_en);
    }

    public function getDescriptionAttribute(): string
    {
        return $this->lang() === 'en'
            ? ($this->description_en ?? $this->description_ar)
            : ($this->description_ar ?? $this->description_en);
    }
}
