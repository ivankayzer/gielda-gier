<?php

namespace App\Providers;

use App\Events\Comments\CommentCreated;
use App\Events\Notifications\NotificationsPageVisited;
use App\Events\Transactions\TransactionAccepted;
use App\Events\Transactions\TransactionCreated;
use App\Events\Transactions\VisitTransactionsPage;
use App\Listeners\MarkNotificationsAsRead;
use App\Listeners\NotifyAboutNewComment;
use App\Listeners\NotifyAboutNewTradeOffer;
use App\Listeners\DeclinePendingTransactionsForOffer;
use App\Listeners\UpdateLastTransactionsVisitDate;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        CommentCreated::class => [
            NotifyAboutNewComment::class,
        ],
        TransactionCreated::class => [
            NotifyAboutNewTradeOffer::class
        ],
        NotificationsPageVisited::class => [
            MarkNotificationsAsRead::class
        ],
        TransactionAccepted::class => [
            DeclinePendingTransactionsForOffer::class
        ],
        VisitTransactionsPage::class => [
            UpdateLastTransactionsVisitDate::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
