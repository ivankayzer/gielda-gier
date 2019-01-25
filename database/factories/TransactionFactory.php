<?php

use App\Game;
use App\Offer;
use Faker\Generator as Faker;

$factory->define(App\Transaction::class, function (Faker $faker) {
    $gameTrade = $faker->randomElement([true, false]);

    return [
        'status_id' => $faker->randomElement([1, 2, 3, 4, 5]),
        'offer_id' => Offer::inRandomOrder()->first()->id,
        'price' => $gameTrade ? null : $faker->numberBetween(1000, 25000)
    ];
});
