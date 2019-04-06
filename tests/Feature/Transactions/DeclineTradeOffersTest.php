<?php

namespace Tests\Feature\Transactions;

use App\Offer;
use App\Transaction;
use App\User;
use App\ValueObjects\TransactionStatus;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class DeclineTradeOffersTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function can_decline_a_trade_offer()
    {
        $user = factory(User::class)->create();
        $transaction = factory(Transaction::class)->create([
            'seller_id' => $user->id,
            'status_id' => TransactionStatus::PENDING
        ]);

        $this->actingAs($user)
            ->get(route('transactions.decline', ['transaction' => $transaction->id]));

        $this->assertDatabaseHas('transactions', [
            'id' => $transaction->id,
            'status_id' => TransactionStatus::DECLINED
        ]);
    }
    
    /** @test */
    public function cant_decline_offers_addressed_to_other_users()
    {
        $user = factory(User::class)->create();
        $secondUser = factory(User::class)->create();
        $transaction = factory(Transaction::class)->create([
            'seller_id' => $user->id,
            'status_id' => TransactionStatus::PENDING
        ]);

        $this->actingAs($secondUser)
            ->get(route('transactions.decline', ['transaction' => $transaction->id]));

        $this->assertDatabaseMissing('transactions', [
            'id' => $transaction->id,
            'status_id' => TransactionStatus::DECLINED
        ]);
    }

    /** @test */
    public function declined_trade_offers_are_visible_on_offers_listing()
    {
        $user = factory(User::class)->create();
        $offer = factory(Offer::class)->state('active')->create(['seller_id' => $user->id]);

        factory(Transaction::class)->create([
            'seller_id' => $user->id,
            'offer_id' => $offer->id,
            'status_id' => TransactionStatus::DECLINED,
        ]);

        $this->get(route('offers.index'))->assertSee($offer->game->title);
    }

    /** @test */
    public function cant_be_traded_after_trade_has_been_declined()
    {
        $user = factory(User::class)->create();

        $transaction = factory(Transaction::class)->create([
            'seller_id' => $user->id,
            'status_id' => TransactionStatus::DECLINED,
        ]);

        $this->actingAs($user)
            ->get(route('transactions.decline', ['transaction' => $transaction->id]))
            ->assertNotFound();

        $transaction = factory(Transaction::class)->create([
            'seller_id' => $user->id,
            'status_id' => TransactionStatus::IN_PROGRESS,
        ]);

        $this->actingAs($user)
            ->get(route('transactions.decline', ['transaction' => $transaction->id]))
            ->assertNotFound();
    }
}
