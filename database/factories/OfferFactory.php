<?php

use Faker\Generator as Faker;

$factory->define(App\Offer::class, function (Faker $faker) {
    return [
        'platform' => $faker->randomElement(array_keys(\App\ValueObjects\Platform::availablePlatforms())),
        'language' => $faker->randomElement(['pl', 'en', 'de',]),
        'price' => $faker->numberBetween(50, 250),
        'game_id' => function () {
            return factory(\App\Game::class)->create()->igdb_id;
        },
        'city_id' => function () {
            return factory(\App\City::class)->create()->id;
        },
    ];
});

$factory->state(\App\Offer::class, 'active', function (Faker $faker) {
    return [
        'is_published' => true,
        'sold' => false,
        'sellable' => true,
    ];
});

$factory->state(\App\Offer::class, 'tradeable', function (Faker $faker) {
    return [
        'is_published' => true,
        'sold' => false,
        'tradeable' => true,
    ];
});

$factory->state(\App\Offer::class, 'user', function (Faker $faker) {
    return [
        'seller_id' => function () {
            return factory(\App\User::class)->create()->id;
        }
    ];
});
