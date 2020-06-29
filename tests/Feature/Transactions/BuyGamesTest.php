<?php

namespace Tests\Feature\Transactions;

use App\Notifications\NewTransaction;
use App\Offer;
use App\Transaction;
use App\User;
use App\ValueObjects\TransactionType;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class BuyGamesTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function guests_cant_see_buy_button()
    {
        $offer = factory(Offer::class)->states(['active', 'user'])->create();

        $this->get($this->offerRoute($offer))
            ->assertDontSee(__('offers.buy'));
    }

    /** @test */
    public function seller_doesnt_see_buy_button_on_own_offers()
    {
        $offer = factory(Offer::class)->states(['active', 'user'])->create();

        $this->actingAs($offer->seller)->get($this->offerRoute($offer))
            ->assertDontSee(__('offers.buy'));
    }

    /** @test */
    public function buy_button_is_visible()
    {
        $user = factory(User::class)->create();
        $offer = factory(Offer::class)->states(['active', 'user'])->create();

        $this->actingAs($user)->get($this->offerRoute($offer))
            ->assertSee(__('offers.buy'));
    }

    /** @test */
    public function can_buy_an_offer()
    {
        $user = factory(User::class)->create();
        $offer = factory(Offer::class)->states(['active', 'user'])->create();

        $this->actingAs($user)->post(route('transactions.create'), [
            'offer_id' => $offer->id,
            'type'     => TransactionType::PURCHASE,
        ]);

        $this->assertDatabaseHas('offers', ['id' => $offer->id, 'sold' => true]);
        $this->assertDatabaseHas('transactions', ['offer_id' => $offer->id]);
    }

    /** @test */
    public function cant_buy_the_same_game_twice()
    {
        $user = factory(User::class)->create();
        $offer = factory(Offer::class)->states(['active', 'user'])->create();

        $this->actingAs($user)->post(route('transactions.create'), [
            'offer_id' => $offer->id,
            'type'     => TransactionType::PURCHASE,
        ]);

        $this->actingAs($user)->get($this->offerRoute($offer))->assertNotFound();

        $this->actingAs($user)->post(route('transactions.create'), [
            'offer_id' => $offer->id,
            'type'     => TransactionType::PURCHASE,
        ])
            ->assertNotFound();

        $this->assertEquals(1, Transaction::where('offer_id', $offer->id)->count());
    }

    /** @test */
    public function cant_buy_own_offer()
    {
        $offer = factory(Offer::class)->states(['active', 'user'])->create();

        $this->actingAs($offer->seller)->post(route('transactions.create'), ['offer_id' => $offer->id]);

        $this->assertDatabaseHas('offers', ['id' => $offer->id, 'sold' => false]);
        $this->assertDatabaseMissing('offers', ['id' => $offer->id, 'sold' => true]);
        $this->assertDatabaseMissing('transactions', ['offer_id' => $offer->id]);
    }

    /** @test */
    public function seller_should_receive_an_email_when_game_is_sold()
    {
        $user = factory(User::class)->create();
        $offer = factory(Offer::class)->states(['active', 'user'])->create();

        Notification::fake();

        Notification::assertNothingSent();

        $this->actingAs($user)->post(route('transactions.create'), [
            'offer_id' => $offer->id,
            'type'     => TransactionType::PURCHASE,
        ]);

        Notification::assertSentTo($offer->seller, NewTransaction::class);
    }

    /** @test */
    public function seller_should_not_receive_an_email_if_he_has_not_given_the_consent()
    {
        $user = factory(User::class)->create();
        $offer = factory(Offer::class)->states(['active', 'user'])->create();
        $offer->seller->profile->update(['notify_new_transaction' => false]);

        Notification::fake();

        Notification::assertNothingSent();

        $this->actingAs($user)->post(route('transactions.create'), ['offer_id' => $offer->id]);

        Notification::assertNothingSent();
    }

    private function offerRoute($offer)
    {
        return route('offers.show', ['offer' => $offer->id, 'slug' => $offer->game->slug]);
    }
}
