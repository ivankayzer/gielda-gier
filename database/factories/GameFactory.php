<?php

use Faker\Generator as Faker;

$factory->define(App\Game::class, function (Faker $faker) {
    return [
        'igdb_id' => $faker->numberBetween(10000, 1000000),
        'title' => ucfirst(join(' ', $faker->words(2))),
        'cover' => $faker->imageUrl(),
        'platforms' => [
            'ps4',
            'xboxone',
            'pc',
        ],
        'release_date' => (new DateTime())->format('Y-m-d'),
    ];
});
