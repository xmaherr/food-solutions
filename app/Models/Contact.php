<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasImageAttribute;

class Contact extends Model
{
    use HasImageAttribute;

    protected $fillable = [
        'type',
        'title',
        'icon',
        'value',
        'link',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
