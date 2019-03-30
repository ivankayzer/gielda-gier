<?php

namespace Tests\Feature;

use App\Offer;
use App\Transaction;
use App\User;
use App\ValueObjects\TransactionStatus;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class AcceptTradeOffersTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function can_accept_a_trade_offer()
    {
        $user = factory(User::class)->create();
        $transaction = factory(Transaction::class)->create([
            'seller_id' => $user->id,
            'status_id' => TransactionStatus::PENDING
        ]);

        $this->actingAs($user)
            ->get(route('transactions.accept', ['transaction' => $transaction->id]));

        $this->assertDatabaseHas('transactions', [
            'id' => $transaction->id,
            'status_id' => TransactionStatus::IN_PROGRESS
        ]);
    }
    
    /** @test */
    public function cant_accept_offers_addressed_to_other_users()
    {
        $user = factory(User::class)->create();
        $secondUser = factory(User::class)->create();
        $transaction = factory(Transaction::class)->create([
            'seller_id' => $user->id,
            'status_id' => TransactionStatus::PENDING
        ]);

        $this->actingAs($secondUser)
            ->get(route('transactions.accept', ['transaction' => $transaction->id]));

        $this->assertDatabaseMissing('transactions', [
            'id' => $transaction->id,
            'status_id' => TransactionStatus::IN_PROGRESS
        ]);
    }
    
    /** @test */
    public function accepting_the_trade_will_make_other_trades_for_this_offer_disappear()
    {
        $user = factory(User::class)->create();
        $offer = factory(Offer::class)->create(['seller_id' => $user->id]);

        $transaction = factory(Transaction::class)->create([
            'seller_id' => $user->id,
            'offer_id' => $offer->id,
            'status_id' => TransactionStatus::PENDING,
        ]);

        $secondTransaction = factory(Transaction::class)->create([
            'seller_id' => $user->id,
            'offer_id' => $offer->id,
            'status_id' => TransactionStatus::PENDING,
        ]);

        $this->actingAs($user)
            ->get(route('transactions.accept', ['transaction' => $transaction->id]));

        $this->assertDatabaseHas('transactions', [
            'id' => $transaction->id,
            'status_id' => TransactionStatus::IN_PROGRESS
        ]);

        $this->assertDatabaseHas('transactions', [
            'id' => $secondTransaction->id,
            'status_id' => TransactionStatus::DECLINED
        ]);
    }
    
    /** @test */
    public function pending_trade_offers_are_still_visible_on_offers_listing()
    {
        $user = factory(User::class)->create();
        $offer = factory(Offer::class)->state('active')->create(['seller_id' => $user->id]);

        factory(Transaction::class)->create([
            'seller_id' => $user->id,
            'offer_id' => $offer->id,
            'status_id' => TransactionStatus::PENDING,
        ]);

        $this->get(route('offers.index'))->assertSee($offer->game->title);
    }

    /** @test */
    public function accepted_trade_offers_are_not_visible_on_offers_listing()
    {
        $user = factory(User::class)->create();
        $offer = factory(Offer::class)->state('active')->create(['seller_id' => $user->id]);

        $transaction = factory(Transaction::class)->create([
            'seller_id' => $user->id,
            'offer_id' => $offer->id,
            'status_id' => TransactionStatus::IN_PROGRESS,
        ]);

        $this->actingAs($user)
            ->get(route('transactions.accept', ['transaction' => $transaction->id]));

        $this->get(route('offers.index'))->assertDontSee($offer->game->title);
    }

    /** @test */
    public function cant_be_traded_after_trade_has_been_accepted()
    {
        $user = factory(User::class)->create();

        $transaction = factory(Transaction::class)->create([
            'seller_id' => $user->id,
            'status_id' => TransactionStatus::IN_PROGRESS,
        ]);

        $this->actingAs($user)
            ->get(route('transactions.accept', ['transaction' => $transaction->id]))
            ->assertNotFound();
    }
}
