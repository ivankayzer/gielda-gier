<?php

use Faker\Generator as Faker;

$factory->define(App\Profile::class, function (Faker $faker) {
    return [
        'description' => $faker->text,
        'name' => $faker->name,
        'surname' => $faker->lastName,
        'address' => $faker->address,
        'zip' => $faker->postcode,
        'city' => $faker->city,
        'phone' => $faker->phoneNumber,
        'bank_nr' => $faker->bankAccountNumber,
        'company_name' => $faker->company,
    ];
});
