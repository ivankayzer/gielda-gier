<?php

use Faker\Generator as Faker;

$factory->define(App\Review::class, function (Faker $faker) {
    return [
        'type' => $faker->randomElement(['positive', 'negative', 'neutral']),
        'comment' => $faker->sentence,
    ];
});
