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

        $type = $request->get('type');

        $transaction->offer_id = $offer->id;

        $transaction->seller_id = $offer->seller_id;
        $transaction->buyer_id = $request->user()->id;

        $transaction->status_id = TransactionStatus::IN_PROGRESS;

        if ($type === TransactionType::TRADE) {
            $transaction->status_id = TransactionStatus::PENDING;
        }

        $transaction->seller_value = [
            [
                'type' => 'game',
                'value' => $offer->game_id
            ]
        ];

        $transaction->price = $type === TransactionType::PURCHASE ? $offer->price : $request->get('money') * 100;

        if ($type === TransactionType::PURCHASE) {
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