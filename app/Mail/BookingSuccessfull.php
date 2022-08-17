<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookingSuccessfull extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $state;
    public $addr;

    public function __construct($state, $addr)
    {
        $this->state = $state;
        $this->addr = $addr;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Successfull Booking")->markdown('emails.bookingSuccessfull', ['state' => $this->state, 'addr' => $this->addr]);
    }
}
