<?php

namespace App;

use App\ValueObjects\Platform;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $dates = [
        'publish_at',
    ];

    protected $flags = [
        'en' => 'gb',
        'pl' => 'pl',
    ];

    protected $fillable = [
        'game_id',
        'platform',
        'language',
        'price',
        'payment_bank_transfer',
        'payment_cash',
        'delivery_post',
        'delivery_in_person',
        'comment',
        'sellable',
        'tradeable',
        'is_published',
        'publish_at',
        'city_id',
    ];

    public function scopeFilter($query, $filters)
    {
        $filters = collect($filters);

        if ($filters->get('city')) {
            [$cityId,] = explode(',', $filters->get('city'));
            $query->where('city_id', $cityId);
        }

        if ($filters->get('platform')) {
            $query->whereIn('platform', $filters->get('platform'));
        }

        if ($filters->get('game_id')) {
            [$gameId,] = explode(',', $filters->get('game_id'));
            $query->join('games', 'games.igdb_id', 'offers.game_id')->where('games.igdb_id', $gameId);
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

        return $query;
    }

    public function scopeActive($query)
    {
        return $query->where('is_published', true)->where('sold', false)->where(function ($query) {
            return $query->where('sellable', true)->orWhere('tradeable', true);
        });
    }

    public function platform()
    {
        return array_get(Platform::availablePlatforms(), $this->platform, null);
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
        return $this->belongsTo(City::class);
    }

    public function setPriceAttribute($value)
    {
        $price = str_replace(' ', '', $value);
        foreach (['.', ','] as $delimiter) {
            if (strpos($price, $delimiter) !== false) {
                $newPrice = explode($delimiter, $price);

                return $this->attributes['price'] = (int)($newPrice[0] . ((strlen($newPrice[1]) === 2) ? $newPrice[1] : ($newPrice[1] . '0')));
            }
        }
        $this->attributes['price'] = (int)$price * 100;
    }

    public function getFloatPrice()
    {
        return str_replace('.', ',', sprintf('%01.2f', $this->price / 100));
    }

    public function getFormattedPriceAttribute()
    {
        return $this->getFloatPrice() . ' zł';
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
            $flag = asset('images/flags/' . $this->flags[$this->language] . '.svg');

            return '<img class="flag" src="' . $flag . '">';
        }
    }

    public function setIsPublishedAttribute($value)
    {
        $this->attributes['is_published'] = $value;

        if ($value) {
            $this->attributes['publish_at'] = Carbon::now();
        }
    }

    public function getSimilar($limit)
    {
        return (new self)
            ->where('game_id', $this->game_id)
            ->where('platform', $this->platform)
            ->where('id', '!=', $this->id)
            ->active()
            ->limit($limit)
            ->get();
    }

    public function actionable()
    {
        return ($this->sellable || $this->tradeable) && !$this->sold && auth()->check() && $this->seller->id !== auth()->user()->id;
    }

    public function isMyOffer()
    {
        return $this->seller_id === auth()->user()->id;
    }
}
