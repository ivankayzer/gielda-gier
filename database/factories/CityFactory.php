<?php

use Faker\Generator as Faker;

$factory->define(App\City::class, function (Faker $faker) {
    return [
        'slug' => $faker->slug,
        'name' => $faker->unique()->words(3, true),
    ];
});
