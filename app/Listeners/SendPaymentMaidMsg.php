<?php

namespace App\Listeners;

use App\Events\PaymentMaid;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendPaymentMaidMsg
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
     * @param  \App\Events\PaymentMaid  $event
     * @return void
     */
    public function handle(PaymentMaid $event)
    {
        //
    }
}
