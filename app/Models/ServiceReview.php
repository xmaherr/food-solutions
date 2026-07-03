<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceReview extends Model
{
    protected $fillable = ['service_id', 'name', 'comment', 'rate'];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}