<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $platformsMap = [
        'ps4' => 'Playstation 4',
        'xboxone' => 'Xbox One',
        'pc' => 'PC'
    ];

    public function scopeActive($query)
    {
        return $query->where('sellable', true)->orWhere('tradeable', true);
    }

    public function platform()
    {
        return array_get($this->platformsMap, $this->platform, null);
    }

    public function seller()
    {
        return $this->belongsTo(User::class);
    }

    public function sellerProfile()
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

    public function city()
    {
        return City::where('slug', $this->sellerProfile->city)->first()->name;
    }

    public function price()
    {
        return $this->price / 100 . ' zł';
    }

    public function buyText()
    {
        if ($this->sellable && $this->tradeable) {
            return __('offers.buy_or_trade');
        }

        if (!$this->sellable && $this->tradeable) {
            return __('offers.trade');
        }

        if ($this->sellable && !$this->tradeable) {
            return __('offers.buy');
        }
    }
}
