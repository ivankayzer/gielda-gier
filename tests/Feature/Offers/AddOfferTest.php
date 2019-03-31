<?php

namespace Tests\Feature\Offers;

use App\City;
use App\Game;
use App\Offer;
use App\Profile;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AddOfferTest extends TestCase
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
    public function user_can_add_an_offer()
    {
        $offer = factory(Offer::class)->make()->toArray();

        $this->actingAs($this->user)->post(route('offers.store'), $offer);

        $this->assertDatabaseHas('offers', [
            'seller_id' => $this->user->id,
            'game_id' => $offer['game_id'],
            'platform' => $offer['platform'],
        ]);
    }

    /** @test */
    public function user_can_set_payment_preferences()
    {
        $offer = factory(Offer::class)->make()->toArray();

        $this->actingAs($this->user)->post(route('offers.store'), array_merge([
            'payment_bank_transfer' => false,
            'payment_cash' => true,
        ], $offer));

        $this->assertDatabaseHas('offers', [
            'seller_id' => $this->user->id,
            'payment_bank_transfer' => false,
            'payment_cash' => true,
        ]);
    }

    /** @test */
    public function user_can_set_delivery_preferences()
    {
        $offer = factory(Offer::class)->make()->toArray();

        $this->actingAs($this->user)->post(route('offers.store'), array_merge([
            'delivery_post' => false,
            'delivery_in_person' => true,
        ], $offer));

        $this->assertDatabaseHas('offers', [
            'seller_id' => $this->user->id,
            'delivery_post' => false,
            'delivery_in_person' => true,
        ]);
    }

    /** @test */
    public function user_can_add_a_comment()
    {
        $offer = factory(Offer::class)->make()->toArray();

        $this->actingAs($this->user)->post(route('offers.store'), array_merge([
            'comment' => 'Example comment',
        ], $offer));

        $this->assertDatabaseHas('offers', [
            'seller_id' => $this->user->id,
            'comment' => 'Example comment',
        ]);
    }

    /** @test */
    public function user_can_add_images()
    {
        Storage::fake('offers');

        $file = UploadedFile::fake()->image('offer.jpg');

        $offer = factory(Offer::class)->make()->toArray();

        $this->actingAs($this->user)->post(route('offers.store'), array_merge([
            'images' => [$file],
        ], $offer));

        $this->assertDatabaseHas('offers', [
            'seller_id' => $this->user->id,
            'game_id' => $offer['game_id'],
        ]);

        Storage::disk('public')->assertExists('offers/' . $file->hashName());

        $this->assertDatabaseHas('offer_images', [
            'url' => 'offers/' . $file->hashName(),
        ]);

        Storage::disk('public')->deleteDirectory('offers');
    }

    /** @test */
    public function offer_can_be_published()
    {
        $offer = factory(Offer::class)->make()->toArray();

        $this->actingAs($this->user)->post(route('offers.store'), array_merge([
            'is_published' => true,
        ], $offer));

        $this->assertDatabaseHas('offers', [
            'seller_id' => $this->user->id,
            'is_published' => true,
            'publish_at' => Carbon::now(),
        ]);
    }

    /** @test */
    public function user_can_set_publish_preferences()
    {
        $offer = factory(Offer::class)->make()->toArray();

        $this->actingAs($this->user)->post(route('offers.store'), array_merge([
            'sellable' => false,
            'tradeable' => true,
            'is_published' => true,
        ], $offer));

        $this->assertDatabaseHas('offers', [
            'seller_id' => $this->user->id,
            'sellable' => false,
            'tradeable' => true,
            'is_published' => true,
        ]);
    }
    
    /** @test */
    public function game_id_is_required_to_add_an_offer()
    {
        $offer = factory(Offer::class)->make();
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->post(route('offers.store'), [
            'platform' => $offer->platform,
            'language' => $offer->language,
            'price' => 0
        ]);

        $response->assertSessionHasErrors('game_id');
    }
    
    /** @test */
    public function platform_is_required_to_add_an_offer()
    {
        $offer = factory(Offer::class)->make();
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->post(route('offers.store'), [
            'game_id' => $offer->game_id,
            'language' => $offer->language,
            'price' => 0
        ]);

        $response->assertSessionHasErrors('platform');
    }
    
    /** @test */
    public function language_is_required_to_add_an_offer()
    {
        $offer = factory(Offer::class)->make();
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->post(route('offers.store'), [
            'game_id' => $offer->game_id,
            'platform' => $offer->platform,
            'price' => 0
        ]);

        $response->assertSessionHasErrors('language');
    }
    
    /** @test */
    public function city_is_required_to_add_an_offer()
    {
        $offer = factory(Offer::class)->make();
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->post(route('offers.store'), [
            'game_id' => $offer->game_id,
            'platform' => $offer->platform,
            'language' => $offer->language,
            'price' => 0
        ]);

        $response->assertSessionHasErrors('city_id');
    }

    /** @test */
    public function price_should_be_greater_than_zero_if_offer_is_sellable()
    {
        $offer = factory(Offer::class)->make();
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->post(route('offers.store'), [
            'game_id' => $offer->game_id,
            'platform' => $offer->platform,
            'language' => $offer->language,
            'price' => 0,
            'sellable' => true,
        ]);

        $response->assertSessionHasErrors('price');
    }

    /** @test */
    public function price_has_to_be_numeric()
    {
        $offer = factory(Offer::class)->make();

        $user = factory(User::class)->create();

        $this->actingAs($user)->post(route('offers.store'), [
            'game_id' => $offer->game_id,
            'platform' => $offer->platform,
            'language' => $offer->language,
            'price' => 'not-valid-price',
            'sellable' => true,
        ])->assertSessionHasErrors('price');
    }

    /** @test */
    public function offer_should_be_sellable_or_tradeable_in_order_to_be_published()
    {
        $offer = factory(Offer::class)->make();
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->post(route('offers.store'), [
            'game_id' => $offer->game_id,
            'platform' => $offer->platform,
            'language' => $offer->language,
            'price' => 10,
            'sellable' => false,
            'tradeable' => false,
            'is_published' => true,
        ]);

        $response->assertSessionHasErrors(['sellable', 'tradeable']);
    }
}
