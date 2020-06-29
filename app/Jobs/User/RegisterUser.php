<?php

namespace App\Jobs\User;

use App\Events\ShouldBeStored;
use App\Events\User\AccountCreated;
use App\User;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RegisterUser implements ShouldBeStored
{
    use Dispatchable;
    use SerializesModels;

    /**
     * @var User
     */
    public $user;

    /**
     * Create a new job instance.
     *
     * @param User $user
     * @param $location
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $this->user->save();

        event(new AccountCreated($this->user));

        return $this->user;
    }
}
