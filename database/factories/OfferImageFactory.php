<?php

use Faker\Generator as Faker;

$factory->define(App\OfferImage::class, function (Faker $faker) {
    return [
        'url' =>  $faker->randomElement([
            'blog-01a.jpg',
            'blog-02a.jpg',
            'blog-03a.jpg',
            'blog-04.jpg',
            'blog-04a.jpg',
            'blog-05a.jpg',
            'blog-06a.jpg',
            'blog-07a.jpg',
        ]),
    ];
});
