<?php

namespace App\Listeners;

use App\Events\Transactions\TransactionAccepted;
use App\Transaction;
use App\ValueObjects\TransactionStatus;

class DeclinePendingTransactionsForOffer
{
    public function handle(TransactionAccepted $event)
    {
        $transaction = Transaction::findOrFail($event->transactionId);

        $transaction->offer->transactions->filter(function ($t) use ($transaction) {
            return $t->id !== $transaction->id;
        })->each(function (Transaction $t) {
            $t->update(['status_id' => TransactionStatus::DECLINED]);
        });
    }
}
