<?php

namespace App\Listeners;

use App\Events\BookingAccepted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendBookingAcceptedMsg
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\BookingAccepted  $event
     * @return void
     */
    public function handle(BookingAccepted $event)
    {
        //
    }
}
