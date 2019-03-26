<?php

namespace App;

use App\Notifications\NewTradeOffer;
use App\Notifications\NewTransaction;
use App\Notifications\ResetPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
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

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'receiver_id');
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    public function sendNewOfferNotification($offer)
    {
        if (!$this->profile->notify_new_offer) {
            return;
        }

        $this->notify(new NewTradeOffer($offer));
    }

    public function sendNewTransactionNotification($transaction)
    {
        if (!$this->profile->notify_new_transaction) {
            return;
        }

        $this->notify(new NewTransaction($transaction));
    }
}
