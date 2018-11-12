<?php

namespace App\Services;

use App\Game;
use App\Transaction;

class SentenceComposer
{
    public static function transactionInfo(Transaction $transaction)
    {
        $isBuyer = $transaction->otherPersonType() === __('transactions.buyer');

        $sellerValue = collect($transaction->seller_value);
        $buyerValue = collect($transaction->buyer_value);

        $sellerText = '';
        $buyerText = '';

        if (array_get($sellerValue->first(), 'type') === 'game') {
            $sellerText = Game::where('igdb_id', array_get($sellerValue->first(), 'value'))->first()->title ?? '';
        } elseif (array_get($sellerValue->first(), 'type') === 'money') {
            $sellerText = array_get($sellerValue->first(), 'value') . __('common.zl');
        }

        if (array_get($buyerValue->first(), 'type') === 'game') {
            $buyerText = Game::where('igdb_id', array_get($buyerValue->first(), 'value'))->first()->title ?? '';
        } elseif (array_get($buyerValue->first(), 'type') === 'money') {
            $buyerText = array_get($buyerValue->first(), 'value') . __('common.zl');
        }

        $firstText = $isBuyer ? $buyerText : $sellerText;
        $lastText = $isBuyer ? $sellerText : $buyerText;

        return "<p><strong>{$firstText}</strong><i style='margin: 0 10px;' class='icon-material-outline-compare-arrows'></i><strong>{$lastText}</strong></p>";
    }
}