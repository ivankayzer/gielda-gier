<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewComposerProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('welcome', function ($view) {
            $view->with('offersCount', [
                'switch' => 0,
                'ps4' => 141,
                'xone' => 221,
                'pc' => 15
            ]);
        });

        View::composer('*', function ($view) {
            if (auth()->guest()) {
                return;
            }
            $notifications = auth()->user()->notifications()->latest()->get();
            $view->with('notificationsCount', $notifications->filter(function ($notification) { return !$notification->is_read; })->count());
            $view->with('notifications', $notifications);

            $sellerCount = 0;
            $buyerCount = 0;

            if (auth()->user()->last_transactions_visit) {
                $sellerCount = auth()->user()->transactionsSeller()->where(
                    'created_at',
                    '>',
                    auth()->user()->last_transactions_visit)->active()->count();

                $buyerCount = auth()->user()->transactionsBuyer()->where(
                    'created_at',
                    '>',
                    auth()->user()->last_transactions_visit)->active()->count();
            }

            $view->with('newTransactionsCount', $buyerCount + $sellerCount);
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
