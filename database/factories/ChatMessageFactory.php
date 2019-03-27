<?php

use Faker\Generator as Faker;

$factory->define(App\ChatMessage::class, function (Faker $faker) {
    return [
        'message' => $faker->sentence,
        'is_read' => true
    ];
});
