<?php

use Faker\Generator as Faker;

$factory->define(App\Transaction::class, function (Faker $faker) {
    return [
        'status_id' => $faker->randomElement([1, 2, 3, 4, 5]),
        'seller_value' => [
            [
                'type' => 'money',
                'value' => 150
            ]
        ],
        'buyer_value' => [
            [
                'type' => 'game',
                'value' => 12345
            ]
        ],
        'price' => $faker->numberBetween(1000, 25000)
    ];
});
