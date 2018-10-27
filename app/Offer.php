<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    public function offeror()
    {
        return $this->belongsTo(User::class);
    }
}
