<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class FinalizingTransactionsTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function type_is_required()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)->post(route('transactions.rate'))->assertSessionHasErrors(['type']);
    }

    /** @test */
    public function transaction_id_is_required()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)->post(route('transactions.rate'))->assertSessionHasErrors(['transaction_id']);
    }
    
    /** @test */
    public function can_finalize_transaction_by_leaving_negative_comment()
    {
    }

    /** @test */
    public function can_finalize_transaction_by_leaving_positive_comment()
    {

    }
    
    /** @test */
    public function finalized_transaction_has_status_completed()
    {
        
    }
    
    /** @test */
    public function can_finalize_only_own_transactions()
    {
        
    }
}
