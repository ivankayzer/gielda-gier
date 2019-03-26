<?php

use Faker\Generator as Faker;

$factory->define(App\Offer::class, function (Faker $faker) {
    return [
        'platform' => $faker->randomElement(array_keys(\App\ValueObjects\Platform::availablePlatforms())),
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
        'publish_at' => $faker->dateTime,
        'seller_id' => function () {
            return factory(\App\User::class)->create()->id;
        },
        'game_id' => function () {
            return factory(\App\Game::class)->create()->igdb_id;
        },
        'city_id' => function () {
            return factory(\App\City::class)->create()->id;
        },
    ];
});
