<?php

namespace App\Services;

use App\Game;
use App\Transaction;
use App\User;

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
            $sellerText = array_get($sellerValue->first(), 'value') . ' ' . __('common.zl');
        }

        if (array_get($buyerValue->first(), 'type') === 'game') {
            $buyerText = Game::where('igdb_id', array_get($buyerValue->first(), 'value'))->first()->title ?? '';
        } elseif (array_get($buyerValue->first(), 'type') === 'money') {
            $buyerText = array_get($buyerValue->first(), 'value') . ' ' . __('common.zl');
        } elseif (is_null($buyerValue->first()) && !is_null($transaction->price)) {
            $buyerText = $transaction->price . ' ' . __('common.zl');
        }

        $firstText = $isBuyer ? $buyerText : $sellerText;
        $lastText = $isBuyer ? $sellerText : $buyerText;

        return "<p><strong>{$firstText}</strong><i style='margin: 0 10px;' class='icon-material-outline-compare-arrows'></i><strong>{$lastText}</strong></p>";
    }

    public static function userInfo(User $user)
    {
        $profile = $user->profile;

        $result = '';

        $result .= "<h3>{$profile->getFullName()}</h3>";
        $result .= "<h3>{$profile->email}</h3>";
        $result .= "<h3>{$profile->phone}</h3>";
        $result .= "<br><span>". __('settings.company_name') . "</span>";
        $result .= "<h3>{$profile->company_name}</h3>";

        $result .= "<br><br><span>". __('common.address') . "</span>";
        $result .= "<h3>{$profile->address}, {$profile->getCity()}, {$profile->zip}</h3>";

        $result .= "<br><br><span>" . __('settings.bank_nr') . "</span>";
        $result .= "<h3>{$profile->bank_nr}</h3>";

        return $result;
    }
}