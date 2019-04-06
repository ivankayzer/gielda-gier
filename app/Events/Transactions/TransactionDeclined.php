<?php

namespace App\Events\Transactions;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class TransactionDeclined
{
    use Dispatchable, SerializesModels;

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
