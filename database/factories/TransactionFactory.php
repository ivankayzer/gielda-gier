<?php

use App\Game;
use App\Offer;
use Faker\Generator as Faker;

$factory->define(App\Transaction::class, function (Faker $faker) {
    $gameTrade = $faker->randomElement([true, false]);
    $seller = factory(\App\User::class)->create();

    return [
        'seller_id' => function () use ($seller) {
            return $seller->id;
        },
        'status_id' => 3,
        'offer_id' => function () use ($seller) {
            return factory(\App\Offer::class)->create([
                'seller_id' => $seller->id
            ])->id;
        },
        'price' => $gameTrade ? null : $faker->numberBetween(1000, 25000)
    ];
});
