<?php

namespace Tests\Feature\Offers;

use App\Offer;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class DeleteOfferTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function user_can_delete_an_offer()
    {
        $user = factory(User::class)->create();

        $offer = factory(Offer::class)->create([
            'seller_id' => $user->id,
        ]);

        $this->actingAs($user)
            ->get(route('offers.delete', ['offer' => $offer->id]));

        $this->assertDatabaseMissing('offers', [
            'id' => $offer->id,
        ]);
    }

    /** @test */
    public function user_cant_delete_other_users_offers()
    {
        $firstUser = factory(User::class)->create();
        $secondUser = factory(User::class)->create();

        $offer = factory(Offer::class)->create([
            'seller_id' => $firstUser->id,
        ]);

        $this->actingAs($secondUser)->get(route(
            'offers.delete',
            ['offer' => $offer->id]
        ))->assertLocation(route('home'));

        $this->assertDatabaseHas('offers', [
            'id' => $offer->id,
        ]);
    }
}
