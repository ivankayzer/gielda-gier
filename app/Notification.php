<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $guarded = [];

    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'desc')->limit(7);
    }
}
