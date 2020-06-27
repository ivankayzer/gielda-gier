<?php

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
                'title' => 'The Last of Us: Part II',
                'cover' => 'co1r0o',
                'background' => 'oh8a5shtmdbqx73cv765',
            ],
            [
                'title' => 'Bioshock Infinite',
                'cover' => 'co1rqj',
                'background' => 'qgfdskdgz6jaejvztexa',
            ],
            [
                'title' => 'Ori and the Blind Forest',
                'cover' => 'co1y41',
                'background' => 'sc5qkg',
            ],
            [
                'title' => 'Marvel\'s Spider-Man',
                'cover' => 'co1r77',
                'background' => 'nofld5l3txxuqhp7j8cc',
            ],
            [
                'title' => 'Hellblade: Senua\'s Sacrifice',
                'cover' => 'co1rcw',
                'background' => 'tyc07nbbbqe2kuosur4b',
            ],
            [
                'title' => 'Dark Souls III',
                'cover' => 'co1vcf',
                'background' => 'nwrsu8awczsx38hmnqx7',
            ],
            [
                'title' => 'The Elder Scrolls V: Skyrim',
                'cover' => 'co1tnw',
                'background' => 'x5bbaqvgbpaz4hzlfeqb',
            ],
            [
                'title' => 'DOOM',
                'cover' => 'co1nc7',
                'background' => 'z8hso07ic2nymktnrdgr',
            ],
            [
                'title' => 'Minecraft Dungeons',
                'cover' => 'co233r',
                'background' => 'sc82ob',
            ],
            [
                'title' => 'Final Fantasy VII Remake',
                'cover' => 'co1qxr',
                'background' => 'sc6vj1',
            ],
            [
                'title' => 'SpongeBob SquarePants: Battle for Bikini Bottom - Rehydrated',
                'cover' => 'co1xrg',
                'background' => 'sc6l60',
            ],
            [
                'title' => 'SnowRunner',
                'cover' => 'co2377',
                'background' => 'sc8032',
            ],
            [
                'title' => 'The Witcher 3: Wild Hunt',
                'cover' => 'co1wyy',
                'background' => 'farvemmmxav0bgt6wx7t',
            ],
            [
                'title' => 'God of War',
                'cover' => 'co1tmu',
                'background' => 'rm35ytrytuka9qkylqyk',
            ],
            [
                'title' => 'Persona 5',
                'cover' => 'co1r76',
                'background' => 'pm074uf0po31urbrjyxz',
            ],
            [
                'title' => 'Uncharted 4: A Thief\'s End',
                'cover' => 'co1r7h',
                'background' => 'tqt0sxjytiovh3g96cl0',
            ],
            [
                'title' => 'The Legend of Zelda: Breath of the Wild',
                'cover' => 'co1vcp',
                'background' => 'ayjm7juog9vitiwbfrcz',
            ],
            [
                'title' => 'Red Dead Redemption 2',
                'cover' => 'co1q1f',
                'background' => 'mptosgjarjlyqxy7lqsm',
            ],
            [
                'title' => 'NieR: Automata',
                'cover' => 'qhok1pi6egmfizjjii7r',
                'background' => 'm5ytymipeljiatfrblhs',
            ],
        ];

        foreach ($games as $game) {
            factory(Game::class)->create($game);
        }


        return;

        factory(User::class, 135)->create()->each(function ($user) {
            /** @var $user User */
            $user->profile()->save(factory(Profile::class)->state('withoutUser')->make());

            foreach (range(1, 5) as $iteration) {
                $offer = $user->offers()->save(factory(\App\Offer::class)->state('active')->make([
                    'game_id' => factory(Game::class)->create()->igdb_id
                ]));

                /** @var $offer \App\Offer */
                foreach (range(1, 3) as $item) {
                    $offer->image()->save(factory(\App\OfferImage::class)->make());
                }

                $user->transactionsSeller()->save(factory(Transaction::class)->make([
                    'buyer_id' => User::inRandomOrder()->where('id', '!=', $user->id)->first()->id
                ]));

                $user->transactionsBuyer()->save(factory(Transaction::class)->make([
                    'seller_id' => User::inRandomOrder()->where('id', '!=', $user->id)->first()->id
                ]));

                $user->reviews()->save(factory(\App\Review::class)->make([
                    'transaction_id' => Transaction::inRandomOrder()->first()->id,
                ]));
            }
        });
    }
}
