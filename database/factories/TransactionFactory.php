<?php

use App\Game;
use App\Offer;
use Faker\Generator as Faker;

$factory->define(App\Transaction::class, function (Faker $faker) {
    return [
        'status_id' => 3,
        'price' => $faker->randomElement([true, false]) ? null : $faker->numberBetween(1000, 25000)
    ];
});
