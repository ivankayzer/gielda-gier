<?php

namespace App\Events\User;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Spatie\EventProjector\ShouldBeStored;

class AccountCreated implements ShouldBeStored
{
    use Dispatchable, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
}
