<?php

namespace App\Events\User;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class ProfileEdited
{
    use Dispatchable, SerializesModels;

    /** @var int */
    public $userId;

    public $oldData;

    public $newData;

    /**
     * Create a new event instance.
     *
     * @param $userId
     * @param $oldData
     * @param $newData
     */
    public function __construct($userId, $oldData, $newData)
    {
        $this->userId = $userId;
        $this->oldData = $oldData;
        $this->newData = $newData;
    }
}
