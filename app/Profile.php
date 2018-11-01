<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getCity()
    {
        return City::where('slug', $this->city)->first()->name;
    }

    public function getFullName()
    {
        return $this->name . ' ' . $this->surname;
    }

    public function getAvatar()
    {
        return $this->avatar ? asset('storage/' . $this->avatar) : asset('images/user-avatar-placeholder.png');
    }
}
