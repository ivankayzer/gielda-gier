<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

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
        return $this->hasMany(Review::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function offered()
    {
        return $this->hasMany(Offer::class);
    }

    public function offers()
    {
        return $this->hasMany(Offer::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function games()
    {
        return $this->belongsToMany(Game::class);
    }
}
