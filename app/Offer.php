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

    protected $dates = [
        'publish_at'
    ];

    protected $flags = [
        'en' => 'gb',
        'pl' => 'pl'
    ];

    public function scopeFilter($query, $filters)
    {
        $filters = collect($filters);

        if ($filters->get('city')) {
            $query->join('profiles', 'profiles.user_id', 'offers.seller_id')->where('profiles.city', $filters->get('city'));
        }

        if ($filters->get('platform')) {
            $query->whereIn('platform', $filters->get('platform'));
        }

        if ($filters->get('name')) {
            $query->join('games', 'games.igdb_id', 'offers.game_id')->where('games.title', 'like', '%' . $filters->get('name') . '%');
        }

        if ($filters->get('price')) {
            [$min, $max] = explode(',', $filters->get('price'));
            $query->whereBetween('price', [$min * 100, $max * 100]);
        }

        if ($filters->get('sort')) {
            [$field, $direction] = explode('_', $filters->get('sort'));

            if ($field === 'date') {
                $field = 'publish_at';
            }

            $query->orderBy($field, $direction);
        } else {
            $query->orderBy('publish_at', 'desc');
        }


        if (!$filters->get('tradeable') || !$filters->get('sellable')) {
            if ($filters->get('tradeable')) {
                $query->where('tradeable', true);
            }

            if ($filters->get('sellable')) {
                $query->where('sellable', true);
            }
        }

        return $query;
    }

    public function scopeActive($query)
    {
        return $query->where('is_published', true)->where(function ($query) {
            return $query->where('sellable', true)->orWhere('tradeable', true);
        });
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

    public function flag()
    {
        if ($this->language && isset($this->flags[$this->language])) {
            return '<img class="flag" src="images/flags/' . $this->flags[$this->language] . '.svg">';
        }
    }
}
