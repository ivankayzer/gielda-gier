<?php

use Faker\Generator as Faker;

$factory->define(App\Transaction::class, function (Faker $faker) {
    return [
        'status_id' => $faker->randomElement([0, 1, 2]),
        'type' => $faker->randomElement(['transaction', 'offer']),
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
        'seller_comment' => $faker->sentence,
        'buyer_comment' => $faker->sentence,
    ];
});
