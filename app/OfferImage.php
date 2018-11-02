<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OfferImage extends Model
{
    protected $fillable = ['url'];

    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }
}
