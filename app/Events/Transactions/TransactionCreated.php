<?php

namespace App\Events\Transactions;

use App\Transaction;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class TransactionCreated
{
    use Dispatchable, SerializesModels;

    /**
     * @var Transaction
     */
    public $transaction;

    /**
     * Create a new event instance.
     *
     * @param Transaction $transaction
     */
    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }
}
