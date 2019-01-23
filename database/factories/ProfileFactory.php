<?php

use App\City;
use Faker\Generator as Faker;

$factory->define(App\Profile::class, function (Faker $faker) {
    return [
        'description' => $faker->text,
        'name' => $faker->name,
        'surname' => $faker->lastName,
        'address' => $faker->address,
        'zip' => $faker->postcode,
        'city' => function () {
            return factory(\App\City::class)->create()->id;
        },
        'phone' => $faker->phoneNumber,
        'bank_nr' => $faker->bankAccountNumber,
        'company_name' => $faker->company,
    ];
});

$factory->state(App\Profile::class, 'withUser', function (Faker $faker) {
    return [
        'user_id' => function () {
            return factory(\App\User::class)->create()->id;
        }
    ];
});
