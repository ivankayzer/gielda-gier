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
        $transaction = new Transaction;

        $transaction->seller_id = $offer->seller_id;
        $transaction->buyer_id = $request->user()->id;

        $transaction->status_id = TransactionStatus::IN_PROGRESS;

        if ($request->get('type') === TransactionType::TRADE) {
            $transaction->status_id = TransactionStatus::PENDING;
        }

        $transaction->seller_value = [
            [
                'type' => 'game',
                'value' => $offer->game_id
            ]
        ];

        $transaction->price = TransactionType::PURCHASE ? $offer->price : $request->get('money');

        if (TransactionType::PURCHASE) {
            return $transaction;
        }

        if ($request->get('game_id')) {
            $transaction->buyer_value = [
                [
                    'type' => 'game',
                    'platform' => $request->get('platform', ''),
                    'game_id' => $request->get('game_id'),
                ]
            ];
        }

        return $transaction;
    }
}