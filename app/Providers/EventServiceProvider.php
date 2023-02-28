<?php

namespace App\Providers;

use App\Events\BookingAccepted;
use App\Events\BookingDeclined;
use App\Events\MakeupBooked;
use App\Events\MakeupBookedAdmin;
use App\Events\PaymentMaid;
use App\Listeners\BookingSuccess;
use App\Listeners\SendBookingAcceptedMsg;
use App\Listeners\SendBookingDeclinedMsg;
use App\Listeners\SendMakeupBookedAdmin;
use App\Listeners\SendPaymentMaidMsg;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

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
        MakeupBooked::class => [
            BookingSuccess::class
        ],
        MakeupBookedAdmin::class => [
            SendMakeupBookedAdmin::class
        ],
        BookingAccepted::class => [
            SendBookingAcceptedMsg::class
        ],
        BookingDeclined::class => [
            SendBookingDeclinedMsg::class
        ],
        PaymentMaid::class => [
            SendPaymentMaidMsg::class
        ]
    ];

    // public function shouldDiscoverEvents()
    // {
    //     return true;
    // }
    
    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
