<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $casts = [
        'platform' => 'array',
        'language' => 'array'
    ];

    public function offeror()
    {
        return $this->belongsTo(User::class);
    }

    public function image()
    {
        return $this->hasMany(OfferImage::class);
    }
}
