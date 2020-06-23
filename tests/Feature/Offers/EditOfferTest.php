<?php

namespace Tests\Feature\Offers;

use App\City;
use App\Game;
use App\Offer;
use App\Profile;
use App\User;
use App\ValueObjects\Platform;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class EditOfferTest extends TestCase
{
    use DatabaseMigrations;

    /** @var User */
    private $user;

    protected function setUp()
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
    }

    /** @test */
    public function user_can_edit_an_offer()
    {
        $city = factory(City::class)->create();
        $secondCity = factory(City::class)->create();

        $offer = factory(Offer::class)->create([
            'seller_id' => $this->user->id,
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

        $this->actingAs($this->user)
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
            'seller_id' => $this->user->id,
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
            'seller_id' => $this->user->id,
        ]);

        $this->actingAs($this->user)
            ->post(route('offers.update', ['offer' => $offer->id]),
                array_merge($offer->toArray(), [
                    'game_id' => $game->igdb_id,
                ]));

        $this->assertDatabaseMissing('offers', [
            'seller_id' => $this->user->id,
            'game_id' => $game->igdb_id,
        ]);

        $this->assertDatabaseHas('offers', [
            'seller_id' => $this->user->id,
            'game_id' => $offer['game_id'],
        ]);
    }

    /** @test */
    public function user_cant_edit_other_users_offers()
    {
        $firstUser = factory(User::class)->create();
        $secondUser = factory(User::class)->create();

        $offer = factory(Offer::class)->create([
            'seller_id' => $firstUser->id,
        ]);

        $this->actingAs($secondUser)->get(route('offers.edit',
            ['offer' => $offer->id]))->assertLocation(route('home'));
    }

    /** @test */
    public function user_can_edit_all_checkboxes()
    {
        $city = factory(City::class)->create();
        $secondCity = factory(City::class)->create();

        $offer = factory(Offer::class)->create([
            'seller_id' => $this->user->id,
            'platform' => 12,
            'language' => 'pl',
            'price' => '500,00',
            'city_id' => $city->id,
            'comment' => 'Example comment',
            'payment_bank_transfer' => true,
            'payment_cash' => true,
            'delivery_post' => true,
            'delivery_in_person' => true,
            'sellable' => true,
            'tradeable' => true,
            'is_published' => true,
        ]);

        $this->actingAs($this->user)
            ->post(route('offers.update', ['offer' => $offer->id]),
                [
                    'platform' => 9,
                    'language' => 'en',
                    'price' => '330,00',
                    'city_id' => $secondCity->id,
                    'comment' => 'Example comment #2',
                ]);

        $this->assertDatabaseHas('offers', [
            'seller_id' => $this->user->id,
            'game_id' => $offer['game_id'],
            'platform' => 9,
            'language' => 'en',
            'price' => '33000',
            'city_id' => $secondCity->id,
            'comment' => 'Example comment #2',
            'payment_bank_transfer' => false,
            'payment_cash' => false,
            'delivery_post' => false,
            'delivery_in_person' => false,
            'sellable' => false,
            'tradeable' => false,
            'is_published' => false,
        ]);
    }
}
