<?php

use Faker\Generator as Faker;

$factory->define(App\Game::class, function (Faker $faker) {
    return [
        'igdb_id' => $faker->numberBetween(10000, 1000000),
        'title' => ucfirst(join(' ', $faker->words(2))),
        'slug' => $faker->slug,
        'url' => $faker->url,
        'cover' => $faker->randomElement([
            'https://images.igdb.com/igdb/image/upload/t_cover_big/ax2kqsyxkwmy2ewqgumx.jpg',
            'https://images.igdb.com/igdb/image/upload/t_cover_big/xvqrf8vseeesyor6nhfn.jpg',
            'https://images.igdb.com/igdb/image/upload/t_cover_big/nxaptelx9e5ttkntu8ro.jpg',
            'https://images.igdb.com/igdb/image/upload/t_cover_big/yfk9f2lbo0r7slytuhra.jpg',
            'https://images.igdb.com/igdb/image/upload/t_cover_big/co1h1a.jpg',
            'https://images.igdb.com/igdb/image/upload/t_cover_big/rrroofmmjqgvgmfxwewd.jpg',
            'https://images.igdb.com/igdb/image/upload/t_cover_big/fgoxeekdfch5w69ufwpb.jpg',
            'https://images.igdb.com/igdb/image/upload/t_cover_big/stgtcfzbombzc15e4epk.jpg',
            'https://images.igdb.com/igdb/image/upload/t_cover_big/knwpjdgqd4dxtvmdccka.jpg',
            'https://images.igdb.com/igdb/image/upload/t_cover_big/sfcxfj5bhvc1ietxxrx1.jpg',
            'https://images.igdb.com/igdb/image/upload/t_cover_big/oohajoszpr1y4emf8syc.jpg',
            'https://images.igdb.com/igdb/image/upload/t_cover_big/dfnfr4vbf3tbcr6daagw.jpg'
        ]),
        'platforms' => [
            'ps4',
            'xboxone',
            'pc',
        ],
        'release_date' => (new DateTime())->getTimestamp() * 1000,
        'background' => $faker->randomElement([
            'https://images.igdb.com/igdb/image/upload/t_screenshot_big/ybliaszwqkwui7djaou4.jpg',
            'https://images.igdb.com/igdb/image/upload/t_screenshot_big/tp3tsdlzfkdp1hhofmb1.jpg',
            'https://images.igdb.com/igdb/image/upload/t_screenshot_big/ukzjmwiud0hdn8jk5fkb.jpg',
            'https://images.igdb.com/igdb/image/upload/t_screenshot_big/xtwej9t60lrwfbazurcy.jpg',
            'https://images.igdb.com/igdb/image/upload/t_screenshot_big/c3wpjcbt3octz1ruzdrn.jpg',
            'https://images.igdb.com/igdb/image/upload/t_screenshot_big/tvzsd22vjayreghdylpv.jpg',
            'https://images.igdb.com/igdb/image/upload/t_screenshot_big/z43tnr86e1bpwrilnlqx.jpg'
        ])
    ];
});
