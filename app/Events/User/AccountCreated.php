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
     * @param User $user
     * @param $location
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
