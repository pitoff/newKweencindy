<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookedNotifyAdmin extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->message = $data['messageAdmin'];
        $this->state = $data['state'];
        $this->addr = $data['addr'];
        $this->cat = $data['cat'];
        $this->location = $data['location'];
        $this->town = $data['town'];
        $this->bookDate = $data['bookDate'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->Subject("Booking Successfull")->markdown('emails.bookedNotifyAdmin', [
            'msg' => $this->message, 
            'state' => $this->state, 
            'addr' => $this->addr,
            'cat' => $this->cat, 
            'location' => $this->location, 
            'town' => $this->town, 
            'date' => $this->bookDate,
            'nil' => "---"
        ]);
    }
}
