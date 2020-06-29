<?php

namespace App\Events\User;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ProfileEdited
{
    use Dispatchable;
    use SerializesModels;

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
