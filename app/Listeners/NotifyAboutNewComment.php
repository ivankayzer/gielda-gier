<?php

namespace App\Listeners;

use App\Events\Comments\CommentCreated;
use App\Notification;

class NotifyAboutNewComment
{
    public function handle(CommentCreated $event)
    {
        $transaction = $event->comment->transaction;

        if ($transaction->buyer_comment && $transaction->seller_comment) {
            return;
        }

        $notification = new Notification;

        $notification->fill([
            'url' => route('transactions.index'),
            'text' => __('notifications.new_comment', [
                'username' => auth()->user()->name,
                'transaction' => $transaction->id,
                'comment' => $event->comment->comment
            ]),
            'receiver_id' => $transaction->otherPerson->id,
            'created_by' => auth()->user()->id
        ])->save();
    }
}