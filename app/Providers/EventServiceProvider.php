<?php

namespace App\Providers;

use App\Events\Comments\CommentCreated;
use App\Events\Transactions\TransactionCreated;
use App\Events\User\AccountCreated;
use App\Listeners\CreateProfile;
use App\Listeners\NotifyAboutNewComment;
use App\Listeners\NotifyAboutNewTradeOffer;
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
        AccountCreated::class => [
            CreateProfile::class,
        ],
        CommentCreated::class => [
            NotifyAboutNewComment::class,
        ],
        TransactionCreated::class => [
            NotifyAboutNewTradeOffer::class
        ]
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
