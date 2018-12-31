<?php

namespace App\Listeners;

use App\Events\User\AccountCreated;

class CreateProfile
{
    public function handle(AccountCreated $event)
    {
        $event->user->profile()->create([
            'city' => $event->location
        ]);
    }
}