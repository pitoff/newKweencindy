<?php

namespace App\Listeners;

use App\Events\PaymentMaid;
use App\Mail\PaymentMarkPaid;
use App\Mail\PaymentMarkPaidAdmin;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendPaymentMaidMsg implements ShouldQueue
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
        $message = "Thank you for notifying us that you have made payment. We will confirm and get back to you shortly";

        $messageAdmin = "$event->email has notified us for payment maid, Please confirm and mark as paid";

        Mail::to($event->email)->send(new PaymentMarkPaid($message));

        $allAdmin = User::where('role', User::ADMIN)->get();
        foreach($allAdmin as $admin){
            Mail::to($admin->email)->send(new PaymentMarkPaidAdmin($messageAdmin));
        }

    }
}
