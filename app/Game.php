<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $casts = [
        'platforms' => 'array'
    ];

    protected $guarded = [];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function setReleaseDateAttribute($value)
    {
        $this->attributes['release_date'] = Carbon::createFromTimestamp($value / 1000)->format('Y-m-d');
    }

    public function getCoverAttribute()
    {
        return sprintf("https://images.igdb.com/igdb/image/upload/t_cover_big/%s.jpg", $this->attributes['cover']);
    }

    public function getBackgroundAttribute()
    {
        return sprintf("https://images.igdb.com/igdb/image/upload/t_screenshot_huge/%s.jpg", $this->attributes['background']);
    }

    public function thumb()
    {
        return sprintf("https://images.igdb.com/igdb/image/upload/t_thumb/%s.jpg", $this->cover);
    }

    public function getUrlParam()
    {
        return join(',', [$this->igdb_id, $this->slug]);
    }
}
