<?php

namespace App\Events\User;

use App\User;

class AccountCreated
{
    /** @var User */
    public $user;

    public $location;

    /**
     * Create a new event instance.
     *
     * @param User $user
     * @param $location
     */
    public function __construct(User $user, $location)
    {
        $this->user = $user;
        $this->location = $location;
    }
}
