<?php

namespace App\Factories;

use App\Offer;
use App\Transaction;
use App\ValueObjects\TransactionStatus;
use App\ValueObjects\TransactionType;
use Illuminate\Http\Request;

class TransactionFactory
{
    public static function fromOffer(Offer $offer, Request $request)
    {
        $transaction = new Transaction();

        $type = $request->get('type');

        $transaction->offer_id = $offer->id;
        $transaction->seller_id = $offer->seller_id;
        $transaction->buyer_id = $request->user()->id;
        $transaction->status_id = TransactionStatus::IN_PROGRESS;

        if ($type === TransactionType::TRADE) {
            $transaction->status_id = TransactionStatus::PENDING;
        }

        $transaction->price = $type === TransactionType::PURCHASE ? $offer->price : self::formatMoney($request->get('money'));

        if ($type === TransactionType::PURCHASE) {
            return $transaction;
        }

        if ($request->get('game_id')) {
            $transaction->buyer_game_id = $request->get('game_id');
            $transaction->buyer_game_platform = $request->get('platform');
        }

        return $transaction;
    }

    private static function formatMoney($value)
    {
        if (! $value) {
            return;
        }

        $price = str_replace(' ', '', $value);
        foreach (['.', ','] as $delimiter) {
            if (strpos($price, $delimiter) !== false) {
                $newPrice = explode($delimiter, $price);

                return (int) ($newPrice[0].((strlen($newPrice[1]) === 2) ? $newPrice[1] : ($newPrice[1].'0')));
            }
        }

        return (int) $price * 100;
    }
}
