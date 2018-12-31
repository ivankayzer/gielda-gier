<?php

namespace App\Jobs\User;

use App\Contracts\ShouldBeStored;
use App\Events\User\AccountCreated;
use App\User;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RegisterUser implements ShouldBeStored
{
    use Dispatchable, SerializesModels;

    /**
     * @var User
     */
    public $user;

    public $location;

    /**
     * Create a new job instance.
     *
     * @param User $user
     * @param $location
     */
    public function __construct(User $user, $location)
    {
        $this->user = $user;
        $this->location = $location;
    }

    /**
     * Execute the job.
     *
     */
    public function handle()
    {
        $this->user->save();

        event(new AccountCreated($this->user, $this->location));

        return $this->user;
    }
}
