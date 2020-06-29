<?php

namespace App\Listeners;

use App\Events\Transactions\TransactionCreated;
use App\Notification;
use App\User;

class NotifyAboutNewTradeOffer
{
    public function handle(TransactionCreated $event)
    {
        $transaction = $event->transaction;

        /** @var User $receiver */
        $receiver = $transaction->otherPerson;

        if (! $transaction->isTrade()) {
            $receiver->sendNewTransactionNotification($transaction);

            return;
        }

        $notification = new Notification();

        $notification->fill([
            'url'  => route('transactions.index'),
            'text' => __('notifications.new_trade_offer', [
                'username' => auth()->user()->name,
            ]),
            'receiver_id' => $receiver->id,
            'created_by'  => auth()->user()->id,
        ])->save();

        $receiver->sendNewOfferNotification($transaction);
    }
}
