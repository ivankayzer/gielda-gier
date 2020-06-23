<?php

namespace App\Listeners;

use Carbon\Carbon;

class UpdateLastTransactionsVisitDate
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        request()->user()->last_transactions_visit = Carbon::now();
        request()->user()->save();
    }
}
