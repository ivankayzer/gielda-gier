<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Profile extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFullName()
    {
        return $this->name . ' ' . $this->surname;
    }

    public function getAvatar()
    {
        return $this->avatar ? asset('storage/' . $this->avatar) : 'images/user-avatar-placeholder.png';
    }
}
