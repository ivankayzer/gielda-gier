<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Krossroad\UnionPaginator\UnionPaginatorTrait;

class User extends \TCG\Voyager\Models\User
{
    use Notifiable, UnionPaginatorTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function offers()
    {
        return $this->hasMany(Offer::class, 'seller_id');
    }

    public function transactions()
    {
        $seller = $this->transactionsSeller();
        $buyer = $this->transactionsBuyer();

        return $seller->union($buyer);
    }

    public function transactionsSeller()
    {
        return $this->hasMany(Transaction::class, 'seller_id');
    }

    public function transactionsBuyer()
    {
        return $this->hasMany(Transaction::class, 'buyer_id');
    }

    public function games()
    {
        return $this->belongsToMany(Game::class);
    }

    public function positiveReviewsCount()
    {
        return $this->reviews()->positive()->count();
    }

    public function negativeReviewsCount()
    {
        return $this->reviews()->negative()->count();
    }

    public function getRouteKeyName()
    {
        return 'name';
    }

    public function chatRooms()
    {
        return $this->belongsToMany(ChatRoom::class);
    }

    public function latestMessages()
    {
        return $this->chatRooms->map(function ($room) {
            return $room->messages()->orderBy('created_at', 'desc')->first();
        })->sortByDesc('created_at');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'receiver_id');
    }
}
