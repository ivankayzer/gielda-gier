<?php

namespace App\Listeners;

use App\Events\Transactions\TransactionCreated;
use App\Notification;

class NotifyAboutNewTradeOffer
{
    public function handle(TransactionCreated $event)
    {
        $transaction = $event->transaction;

        if (!$transaction->isTrade()) {
            return;
        }

        (new Notification())->fill([
            'url' => route('transactions.index'),
            'text' => __('notifications.new_trade_offer', [
                'username' => auth()->user()->name,
            ]),
            'receiver_id' => $transaction->otherPerson->id,
            'created_by' => auth()->user()->id
        ])->save();
    }
}