<?php

namespace App\Events\User;

use App\User;

class AccountCreated
{
    /** @var User */
    public $user;

    /**
     * Create a new event instance.
     *
     * @param $userId
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
