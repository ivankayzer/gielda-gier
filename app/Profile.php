<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'name',
        'surname',
        'phone',
        'address',
        'city_id',
        'zip',
        'description',
        'bank_nr',
        'company_name',
        'notify_new_offer',
        'notify_new_transaction',
    ];

    protected $casts = [
        'notify_new_offer' => 'boolean',
        'notify_new_transaction' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
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
