<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Game extends Model
{
    use Searchable;

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

    public function getScoutKey()
    {
        return $this->slug;
    }

    public function searchableAs()
    {
        return 'games';
    }

    public function toSearchableArray()
    {
        $attributes = $this->only(['title']);
        $attributes['cover'] = $this->thumb();
        $attributes['id'] = $this->igdb_id;

        return $attributes;
    }

    public function getUrlParam()
    {
        return join(',', [$this->igdb_id, $this->slug]);
    }
}
