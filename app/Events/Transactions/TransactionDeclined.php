<?php

namespace App\Events\Transactions;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TransactionDeclined
{
    use Dispatchable;
    use SerializesModels;

    public $transactionId;

    /**
     * Create a new event instance.
     *
     * @param $transactionId
     */
    public function __construct($transactionId)
    {
        $this->transactionId = $transactionId;
    }
}
