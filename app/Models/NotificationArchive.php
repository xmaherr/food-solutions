<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationArchive extends Model
{
    protected $fillable = ['title', 'body', 'topic', 'is_sent'];
}