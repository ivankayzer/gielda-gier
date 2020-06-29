<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Notification extends Model
{
    protected $guarded = [];

    public static function markAsRead()
    {
        DB::table('notifications')
            ->where('receiver_id', auth()->user()->id)
            ->where('is_read', false)
            ->update([
                'is_read' => true,
            ]);
    }

    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'desc')->limit(7);
    }
}
