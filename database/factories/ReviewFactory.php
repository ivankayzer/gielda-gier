<?php

use Faker\Generator as Faker;

$factory->define(App\Review::class, function (Faker $faker) {
    return [
        'type'    => $faker->randomElement(['positive', 'negative']),
        'comment' => $faker->sentence,
    ];
});
