<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Traits\HasImageAttribute;

class HomeSection extends Model
{
    use HasImageAttribute;

    protected $fillable = [
        'image',
        'title',
        'subtitle',
        'description',
        'sort_order',
    ];
}
