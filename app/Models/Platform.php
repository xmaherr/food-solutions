<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Platform extends Model
{
    protected $fillable = ['name_ar', 'name_en', 'color'];

    /**
     * Returns the platform name in the currently resolved language.
     * Reads from the application container (set by SetLanguageMiddleware).
     * Falls back to Arabic when running outside an HTTP context.
     */
    public function getNameAttribute(): string
    {
        $lang = app()->bound('current_language') ? app('current_language') : 'ar';

        return $lang === 'en' ? ($this->name_en ?? $this->name_ar) : ($this->name_ar ?? $this->name_en);
    }
}
