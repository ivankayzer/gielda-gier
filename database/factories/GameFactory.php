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
            'https://images.igdb.com/igdb/image/upload/t_screenshot_big/ybliaszwqkwui7djaou4',
            'https://images.igdb.com/igdb/image/upload/t_screenshot_big/tp3tsdlzfkdp1hhofmb1',
            'https://images.igdb.com/igdb/image/upload/t_screenshot_big/ukzjmwiud0hdn8jk5fkb',
            'https://images.igdb.com/igdb/image/upload/t_screenshot_big/xtwej9t60lrwfbazurcy',
            'https://images.igdb.com/igdb/image/upload/t_screenshot_big/c3wpjcbt3octz1ruzdrn',
            'https://images.igdb.com/igdb/image/upload/t_screenshot_big/tvzsd22vjayreghdylpv',
            'https://images.igdb.com/igdb/image/upload/t_screenshot_big/z43tnr86e1bpwrilnlqx'
        ])
    ];
});
