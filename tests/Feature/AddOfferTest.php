<?php

namespace Tests\Feature;

use App\City;
use App\Game;
use App\Offer;
use App\Profile;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AddOfferTest extends TestCase
{
    use DatabaseMigrations;

    /** @var Profile */
    private $profile;

    protected function setUp()
    {
        parent::setUp();

        $this->profile = factory(Profile::class)->state('withUser')->create();
    }

    /** @test */
    public function user_can_add_an_offer()
    {
        $offer = factory(Offer::class)->make()->toArray();

        $this->actingAs($this->profile->user)->post(route('offers.store'), $offer);

        $this->assertDatabaseHas('offers', [
            'seller_id' => $this->profile->user_id,
            'game_id' => $offer['game_id'],
            'platform' => $offer['platform'],
        ]);
    }

    /** @test */
    public function user_can_set_payment_preferences()
    {
        $offer = factory(Offer::class)->make()->toArray();

        $this->actingAs($this->profile->user)->post(route('offers.store'), array_merge([
            'payment_bank_transfer' => false,
            'payment_cash' => true,
        ], $offer));

        $this->assertDatabaseHas('offers', [
            'seller_id' => $this->profile->user_id,
            'payment_bank_transfer' => false,
            'payment_cash' => true,
        ]);
    }

    /** @test */
    public function user_can_set_delivery_preferences()
    {
        $offer = factory(Offer::class)->make()->toArray();

        $this->actingAs($this->profile->user)->post(route('offers.store'), array_merge([
            'delivery_post' => false,
            'delivery_in_person' => true,
        ], $offer));

        $this->assertDatabaseHas('offers', [
            'seller_id' => $this->profile->user_id,
            'delivery_post' => false,
            'delivery_in_person' => true,
        ]);
    }

    /** @test */
    public function user_can_add_a_comment()
    {
        $offer = factory(Offer::class)->make()->toArray();

        $this->actingAs($this->profile->user)->post(route('offers.store'), array_merge([
            'comment' => 'Example comment',
        ], $offer));

        $this->assertDatabaseHas('offers', [
            'seller_id' => $this->profile->user_id,
            'comment' => 'Example comment',
        ]);
    }

    /** @test */
    public function user_can_add_images()
    {
        Storage::fake('offers');

        $file = UploadedFile::fake()->image('offer.jpg');

        $offer = factory(Offer::class)->make()->toArray();

        $this->actingAs($this->profile->user)->post(route('offers.store'), array_merge([
            'images' => [$file],
        ], $offer));

        $this->assertDatabaseHas('offers', [
            'seller_id' => $this->profile->user_id,
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

        $this->actingAs($this->profile->user)->post(route('offers.store'), array_merge([
            'is_published' => true,
        ], $offer));

        $this->assertDatabaseHas('offers', [
            'seller_id' => $this->profile->user_id,
            'is_published' => true,
            'publish_at' => Carbon::now(),
        ]);
    }

    /** @test */
    public function user_can_set_publish_preferences()
    {
        $offer = factory(Offer::class)->make()->toArray();

        $this->actingAs($this->profile->user)->post(route('offers.store'), array_merge([
            'sellable' => false,
            'tradeable' => true,
            'is_published' => true,
        ], $offer));

        $this->assertDatabaseHas('offers', [
            'seller_id' => $this->profile->user_id,
            'sellable' => false,
            'tradeable' => true,
            'is_published' => true,
        ]);
    }
}
