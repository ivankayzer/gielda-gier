<?php

namespace Tests\Feature;

use App\City;
use App\Game;
use App\Offer;
use App\Profile;
use App\ValueObjects\Platform;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class EditOfferTest extends TestCase
{
    use DatabaseMigrations;

    /** @var Profile */
    private $profile;

    protected function setUp()
    {
        parent::setUp();

        $this->profile = factory(Profile::class)->create();
    }

    /** @test */
    public function user_can_edit_an_offer()
    {
        $city = factory(City::class)->create();
        $secondCity = factory(City::class)->create();

        $offer = factory(Offer::class)->create([
            'seller_id' => $this->profile->user_id,
            'platform' => 12,
            'language' => 'pl',
            'price' => '500,00',
            'city_id' => $city->id,
            'payment_bank_transfer' => false,
            'payment_cash' => false,
            'delivery_post' => false,
            'delivery_in_person' => false,
            'comment' => 'Example comment',
            'sellable' => false,
            'tradeable' => false,
            'is_published' => false,
        ]);

        $this->actingAs($this->profile->user)
            ->post(route('offers.update', ['offer' => $offer->id]),
                array_merge($offer->toArray(), [
                    'platform' => 9,
                    'language' => 'en',
                    'price' => '330,00',
                    'city_id' => $secondCity->id,
                    'payment_bank_transfer' => true,
                    'payment_cash' => true,
                    'delivery_post' => true,
                    'delivery_in_person' => true,
                    'comment' => 'Example comment #2',
                    'sellable' => true,
                    'tradeable' => true,
                    'is_published' => true,
                ]));

        $this->assertDatabaseHas('offers', [
            'seller_id' => $this->profile->user_id,
            'game_id' => $offer['game_id'],
            'platform' => 9,
            'language' => 'en',
            'price' => '33000',
            'city_id' => $secondCity->id,
            'payment_bank_transfer' => true,
            'payment_cash' => true,
            'delivery_post' => true,
            'delivery_in_person' => true,
            'comment' => 'Example comment #2',
            'sellable' => true,
            'tradeable' => true,
            'is_published' => true,
        ]);
    }

    /** @test */
    public function user_cant_change_game_id()
    {
        $game = factory(Game::class)->create();

        $offer = factory(Offer::class)->create([
            'seller_id' => $this->profile->user_id,
        ]);

        $this->actingAs($this->profile->user)
            ->post(route('offers.update', ['offer' => $offer->id]),
                array_merge($offer->toArray(), [
                    'game_id' => $game->igdb_id,
                ]));

        $this->assertDatabaseMissing('offers', [
            'seller_id' => $this->profile->user_id,
            'game_id' => $game->igdb_id,
        ]);

        $this->assertDatabaseHas('offers', [
            'seller_id' => $this->profile->user_id,
            'game_id' => $offer['game_id'],
        ]);
    }

    /** @test */
    public function user_cant_edit_other_users_offers()
    {
        $firstUser = factory(Profile::class)->create();
        $secondUser = factory(Profile::class)->create();

        $offer = factory(Offer::class)->create([
            'seller_id' => $firstUser->user_id,
        ]);

        $this->actingAs($secondUser->user)->get(route('offers.edit',
            ['offer' => $offer->id]))->assertLocation(route('home'));
    }
}
