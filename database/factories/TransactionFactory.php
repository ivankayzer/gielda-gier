<?php

use App\Game;
use App\Offer;
use Faker\Generator as Faker;

$factory->define(App\Transaction::class, function (Faker $faker) {
    return [
        'status_id' => $faker->randomElement([1, 2, 3, 4, 5]),
        'offer_id' => Offer::inRandomOrder()->first()->id,
        'seller_value' => [
            [
                'type' => 'money',
                'value' => 150
            ]
        ],
        'buyer_value' => [
            [
                'type' => 'game',
                'value' => Game::inRandomOrder()->first()->igdb_id
            ]
        ],
        'price' => $faker->numberBetween(1000, 25000)
    ];
});
