<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    public function reviewee()
    {
        return $this->belongsTo(User::class);
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class);
    }
}
