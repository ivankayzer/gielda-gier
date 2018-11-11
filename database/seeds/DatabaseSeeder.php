<?php

use App\Game;
use App\Profile;
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

        factory(Game::class, 50)->create();

        factory(User::class, 10)->create()->each(function ($user) {
            /** @var $user User */
            $user->profile()->save(factory(Profile::class)->make());

            foreach (range(1, 5) as $iteration) {
                $offer = $user->offers()->save(factory(\App\Offer::class)->make([
                    'game_id' => Game::inRandomOrder()->first()->igdb_id
                ]));

                /** @var $offer \App\Offer */
                foreach (range(1, 3) as $item) {
                    $offer->image()->save(factory(\App\OfferImage::class)->make());
                }

                $user->transactionsSeller()->save(factory(\App\Transaction::class)->make([
                    'buyer_id' => User::inRandomOrder()->where('id', '!=', $user->id)->first()->id
                ]));

                $user->transactionsBuyer()->save(factory(\App\Transaction::class)->make([
                    'seller_id' => User::inRandomOrder()->where('id', '!=', $user->id)->first()->id
                ]));
            }
        });
    }
}
