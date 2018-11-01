<?php

use Faker\Generator as Faker;

$factory->define(App\Offer::class, function (Faker $faker) {
    return [
        'platform' => $faker->randomElement([
            'ps4',
            'xboxone',
            'pc'
        ]),
        'language' => $faker->randomElement([
            'pl',
            'en',
            'de'
        ]),
        'price' => $faker->numberBetween(50, 250) * 100,
        'comment' => $faker->sentence,
        'sellable' => $faker->randomElement([true, false]),
        'tradeable' => $faker->randomElement([true, false]),
        'payment_bank_transfer' => $faker->randomElement([true, false]),
        'payment_cash' => $faker->randomElement([true, false]),
        'delivery_post' => $faker->randomElement([true, false]),
        'delivery_in_person' => $faker->randomElement([true, false]),
        'is_published' => $faker->randomElement([true, false]),
        'publish_at' => $faker->dateTime
    ];
});
