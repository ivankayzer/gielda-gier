<?php

namespace App\Providers;

use App\Offer;
use App\User;
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
            $view->with('usersCount', number_format(User::count()));
            $view->with('totalOffersCount', number_format(Offer::count()));
            $view->with('offersCount', [
                'switch' => Offer::where(['platform' => 130])->count(),
                'ps4' => Offer::where(['platform' => 48])->count(),
                'xone' => Offer::where(['platform' => 49])->count(),
                'pc' => Offer::where(['platform' => 15])->count()
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
