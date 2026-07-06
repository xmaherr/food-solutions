<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasImageAttribute;

class Contact extends Model
{
    use HasImageAttribute;

    protected $fillable = [
        'type',
        'title_ar',
        'title_en',
        'icon',
        'value',
        'link',
        'sort_order',
        'is_active',
        'platform_id',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Returns the contact title in the currently resolved language.
     * Falls back to Arabic when running outside an HTTP context.
     */
    public function getTitleAttribute(): ?string
    {
        $lang = app()->bound('current_language') ? app('current_language') : 'ar';

        return $lang === 'en' ? ($this->title_en ?? $this->title_ar) : ($this->title_ar ?? $this->title_en);
    }

    public function platform()
    {
        return $this->belongsTo(Platform::class);
    }
}
