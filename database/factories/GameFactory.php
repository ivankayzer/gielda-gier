<?php

use Faker\Generator as Faker;

$factory->define(App\Game::class, function (Faker $faker) {
    return [
        'igdb_id' => $faker->numberBetween(10000, 1000000),
        'title' => ucfirst(join(' ', $faker->words(2))),
        'slug' => $faker->slug,
        'url' => $faker->url,
        'cover' => $faker->randomElement([
            'ax2kqsyxkwmy2ewqgumx',
            'xvqrf8vseeesyor6nhfn',
            'nxaptelx9e5ttkntu8ro',
            'yfk9f2lbo0r7slytuhra',
            'co1h1a',
            'rrroofmmjqgvgmfxwewd',
            'fgoxeekdfch5w69ufwpb',
            'stgtcfzbombzc15e4epk',
            'knwpjdgqd4dxtvmdccka',
            'sfcxfj5bhvc1ietxxrx1',
            'oohajoszpr1y4emf8syc',
            'dfnfr4vbf3tbcr6daagw'
        ]),
        'platforms' => [
            'ps4',
            'xboxone',
            'pc',
        ],
        'release_date' => (new DateTime())->getTimestamp() * 1000,
        'background' => $faker->randomElement([
            'ybliaszwqkwui7djaou4',
            'tp3tsdlzfkdp1hhofmb1',
            'ukzjmwiud0hdn8jk5fkb',
            'xtwej9t60lrwfbazurcy',
            'c3wpjcbt3octz1ruzdrn',
            'tvzsd22vjayreghdylpv',
            'z43tnr86e1bpwrilnlqx'
        ])
    ];
});
