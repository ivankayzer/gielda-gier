<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Krossroad\UnionPaginator\UnionPaginatorTrait;

class User extends Authenticatable
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

    public function reviewed()
    {
        return $this->hasMany(Review::class, 'reviewer_id', 'id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'reviewee_id', 'id');
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
}
