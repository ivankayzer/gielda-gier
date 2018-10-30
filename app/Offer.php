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

    public function oferrorProfile()
    {
        return $this->belongsTo(Profile::class, 'seller_id', 'user_id');
    }

    public function image()
    {
        return $this->hasMany(OfferImage::class);
    }

    public function game()
    {
        return $this->belongsTo(Game::class, 'game_id', 'igdb_id');
    }

    public function humanCreatedAt()
    {
        return $this->created_at->diffForHumans();
    }
}
