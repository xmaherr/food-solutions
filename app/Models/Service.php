<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasImageAttribute;

class Service extends Model
{
    use HasImageAttribute;

    protected $fillable = [
        'title_ar',
        'icon',
        'short_description_ar',
        'long_description_ar',
        'points',
        'image',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'points' => 'array',
        'is_active' => 'boolean',
    ];

    public function consultations()
    {
        return $this->hasMany(Consultation::class);
    }
}
