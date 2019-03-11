<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded = [];

    protected $casts = [
        'notify_new_offer' => 'boolean',
        'notify_new_transaction' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getCity()
    {
        if (!$this->city) {
            return '';
        }

        return City::where('slug', $this->city)->first()->name;
    }

    public function getFullName()
    {
        if ($this->name && $this->surname) {
            return $this->name . ' ' . $this->surname;
        }

        return $this->user->name;
    }

    public function getAvatar()
    {
        return $this->avatar ? asset('storage/' . $this->avatar) : asset('images/user-avatar-placeholder.png');
    }
}
