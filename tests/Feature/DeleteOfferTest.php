<?php

namespace Tests\Feature;

use App\Offer;
use App\Profile;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class DeleteOfferTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function user_can_delete_an_offer()
    {
        $profile = factory(Profile::class)->create();

        $offer = factory(Offer::class)->create([
            'seller_id' => $profile->user_id,
        ]);

        $this->actingAs($profile->user)
            ->get(route('offers.delete', ['offer' => $offer->id]));

        $this->assertDatabaseMissing('offers', [
            'id' => $offer->id,
        ]);
    }

    /** @test */
    public function user_cant_delete_other_users_offers()
    {
        $firstUser = factory(Profile::class)->create();
        $secondUser = factory(Profile::class)->create();

        $offer = factory(Offer::class)->create([
            'seller_id' => $firstUser->user_id,
        ]);

        $this->actingAs($secondUser->user)->get(route('offers.delete',
            ['offer' => $offer->id]))->assertLocation(route('home'));

        $this->assertDatabaseHas('offers', [
            'id' => $offer->id,
        ]);
    }
}
