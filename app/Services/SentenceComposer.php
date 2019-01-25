<?php

namespace App\Services;

use App\Transaction;
use App\User;

class SentenceComposer
{
    public static function transactionInfo(Transaction $transaction)
    {
        return '';
    }

    public static function revieweeTransactionText(Transaction $transaction)
    {
        return '';
    }

    /**
     * @param User $user
     * @return string
     * @throws \Throwable
     */
    public static function userInfo(User $user)
    {
        return view('chunks.user_info', [
            'profile' => $user->profile
        ])->render();
    }
}