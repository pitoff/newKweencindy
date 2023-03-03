<?php

namespace App\Listeners;

use App\Events\PaymentNotReceived;
use App\Mail\PaymentNotReceived as MailPaymentNotReceived;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendPaymentNotReceivedMsg implements ShouldQueue
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
     * @param  \App\Events\PaymentNotReceived  $event
     * @return void
     */
    public function handle(PaymentNotReceived $event)
    {
        $message = "Sorry, but we have not received and confirmed your payment";
        Mail::to($event->email)->send(new MailPaymentNotReceived($message));
    }
}
