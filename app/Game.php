<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $casts = [
        'platforms' => 'array'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
