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

    public function thumb()
    {
        return sprintf("https://images.igdb.com/igdb/image/upload/t_thumb/%s.jpg", $this->cover);
    }

    public function getScoutKey()
    {
        return $this->slug;
    }

    public function toSearchableArray()
    {
        $attributes = $this->only(['title', 'id']);
        $attributes['cover'] = $this->thumb();

        return $attributes;
    }
}
