<?php

namespace App\Listeners;

use App\Events\BookingDeclined;
use App\Mail\BookingDeclined as MailBookingDeclined;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendBookingDeclinedMsg implements ShouldQueue
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
        $data['message'] = "We are sorry, your booking was declined.";
        Mail::to($event->email)->send(new MailBookingDeclined($data));
    }
}
