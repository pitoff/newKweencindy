<?php

namespace App\Listeners;

use App\Events\BookingDeclined;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendBookingDeclinedMsg
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
     * @param  \App\Events\BookingDeclined  $event
     * @return void
     */
    public function handle(BookingDeclined $event)
    {
        //
    }
}
