<?php

namespace App\Listeners;

use App\Events\PaymentReceived;
use App\Mail\PaymentReceived as MailPaymentReceived;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendPaymentReceivedMsg implements ShouldQueue
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
     * @param  \App\Events\PaymentReceived  $event
     * @return void
     */
    public function handle(PaymentReceived $event)
    {
        $message = "We have confirmed and received payment for your booking";
        Mail::to($event->email)->send(new MailPaymentReceived($message));
    }
}
