<?php

namespace App\Listeners;

use App\Events\BookingAccepted;
use App\Mail\BookingAccepted as MailBookingAccepted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

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
        $data['message'] = "Thank you, We have accepted your booking";
        Mail::to($event->email)->send(new MailBookingAccepted($data));
    }
}
