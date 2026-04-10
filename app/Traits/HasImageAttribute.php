<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait HasImageAttribute
{
    /**
     * Get the absolute URL for the image attribute.
     */
    protected function image(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                if (!$value) {
                    return null;
                }
                
                // If the stored value is already an absolute URL, return it as is
                if (Str::startsWith($value, ['http://', 'https://'])) {
                    return $value;
                }

                // Otherwise, it's a relative path in public storage, so return the absolute URL
                return config('app.url') . Storage::url($value);
            },
        );
    }
    
    /**
     * Get the absolute URL for the icon attribute (if present).
     */
    protected function icon(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                if (!$value) {
                    return null;
                }
                
                // If it's something like "fa fa-star", we might return it as-is,
                // but checking for basic file extensions to see if it's an uploaded file path.
                if (preg_match('/\.(jpg|jpeg|png|gif|svg|webp)$/i', $value)) {
                     // It is a file path
                     if (Str::startsWith($value, ['http://', 'https://'])) {
                         return $value;
                     }
                     return config('app.url') . Storage::url($value);
                }

                // If it's a string identifier like an icon class, return as is
                return $value;
            },
        );
    }
}
