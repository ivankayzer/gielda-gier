<?php

use App\City;
use App\Game;
use App\Profile;
use App\Transaction;
use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CitiesSeeder::class);

        $games = [
            [
                'title'      => 'The Last of Us: Part II',
                'cover'      => 'co1r0o',
                'background' => 'oh8a5shtmdbqx73cv765',
            ],
            [
                'title'      => 'Bioshock Infinite',
                'cover'      => 'co1rqj',
                'background' => 'qgfdskdgz6jaejvztexa',
            ],
            [
                'title'      => 'Ori and the Blind Forest',
                'cover'      => 'co1y41',
                'background' => 'sc5qkg',
            ],
            [
                'title'      => 'Marvel\'s Spider-Man',
                'cover'      => 'co1r77',
                'background' => 'nofld5l3txxuqhp7j8cc',
            ],
            [
                'title'      => 'Hellblade: Senua\'s Sacrifice',
                'cover'      => 'co1rcw',
                'background' => 'tyc07nbbbqe2kuosur4b',
            ],
            [
                'title'      => 'Dark Souls III',
                'cover'      => 'co1vcf',
                'background' => 'nwrsu8awczsx38hmnqx7',
            ],
            [
                'title'      => 'The Elder Scrolls V: Skyrim',
                'cover'      => 'co1tnw',
                'background' => 'x5bbaqvgbpaz4hzlfeqb',
            ],
            [
                'title'      => 'DOOM',
                'cover'      => 'co1nc7',
                'background' => 'z8hso07ic2nymktnrdgr',
            ],
            [
                'title'      => 'Minecraft Dungeons',
                'cover'      => 'co233r',
                'background' => 'sc82ob',
            ],
            [
                'title'      => 'Final Fantasy VII Remake',
                'cover'      => 'co1qxr',
                'background' => 'sc6vj1',
            ],
            [
                'title'      => 'SpongeBob SquarePants: Battle for Bikini Bottom - Rehydrated',
                'cover'      => 'co1xrg',
                'background' => 'sc6l60',
            ],
            [
                'title'      => 'SnowRunner',
                'cover'      => 'co2377',
                'background' => 'sc8032',
            ],
            [
                'title'      => 'The Witcher 3: Wild Hunt',
                'cover'      => 'co1wyy',
                'background' => 'farvemmmxav0bgt6wx7t',
            ],
            [
                'title'      => 'God of War',
                'cover'      => 'co1tmu',
                'background' => 'rm35ytrytuka9qkylqyk',
            ],
            [
                'title'      => 'Persona 5',
                'cover'      => 'co1r76',
                'background' => 'pm074uf0po31urbrjyxz',
            ],
            [
                'title'      => 'Uncharted 4: A Thief\'s End',
                'cover'      => 'co1r7h',
                'background' => 'tqt0sxjytiovh3g96cl0',
            ],
            [
                'title'      => 'The Legend of Zelda: Breath of the Wild',
                'cover'      => 'co1vcp',
                'background' => 'ayjm7juog9vitiwbfrcz',
            ],
            [
                'title'      => 'Red Dead Redemption 2',
                'cover'      => 'co1q1f',
                'background' => 'mptosgjarjlyqxy7lqsm',
            ],
            [
                'title'      => 'NieR: Automata',
                'cover'      => 'qhok1pi6egmfizjjii7r',
                'background' => 'm5ytymipeljiatfrblhs',
            ],
        ];

        foreach ($games as $game) {
            factory(Game::class)->create($game);
        }

        $gameIds = Game::pluck('igdb_id');
        $cityIds = City::pluck('id');

        // user avatar

        factory(User::class, 135)->create(['city_id' => $cityIds->shuffle()->first()])->each(function ($user) use ($gameIds, $cityIds) {
            $user->profile()->delete();
            /** @var $user User */
            factory(Profile::class)->create(['user_id' => $user->id]);

            $offersCount = rand(0, 2);

            if (! $offersCount) {
                return;
            }

            $reviewSaved = false;

            foreach (range(0, $offersCount) as $i) {
                /** @var $offer \App\Offer */
                $offer = $user->offers()->save(factory(\App\Offer::class)->state('active')->make([
                    'game_id' => $gameIds->shuffle()->first(),
                    'city_id' => $cityIds->shuffle()->first(),
                ]));

                $user->transactionsSeller()->save(factory(Transaction::class)->make([
                    'offer_id'  => $offer->id,
                    'seller_id' => $user->id,
                    'buyer_id'  => User::inRandomOrder()->where('id', '!=', $user->id)->first()->id,
                ]));

                $user->transactionsBuyer()->save(factory(Transaction::class)->make([
                    'offer_id'  => $offer->id,
                    'buyer_id'  => $user->id,
                    'seller_id' => User::inRandomOrder()->where('id', '!=', $user->id)->first()->id,
                ]));

                $transaction = Transaction::inRandomOrder()->where('seller_id', $user->id)->orWhere('buyer_id', $user->id)->first();

                if ($transaction && ! $reviewSaved) {
                    factory(\App\Review::class)->create([
                        'transaction_id' => $transaction->id,
                        'user_id'        => $transaction->seller_id === $user->id ? $transaction->buyer_id : $transaction->seller_id,
                    ]);
                    $reviewSaved = true;
                }

                $offerImagesCount = rand(0, 2);

                if (! $offerImagesCount) {
                    return;
                }

                foreach (range(0, $offerImagesCount) as $i) {
                    $offer->image()->save(factory(\App\OfferImage::class)->make());
                }
            }
        });
    }
}
