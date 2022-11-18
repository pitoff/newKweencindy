<?php

namespace App\Listeners;

use App\Events\MakeupBooked;
use App\Mail\BookedNotifyAdmin;
use App\Mail\BookingSuccessfull;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class BookingSuccess implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */

    public $tries = 5;
    
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\MakeupBooked  $event
     * @return void
     */
    public function handle(MakeupBooked $event)
    {
        $data['message'] = "Thank you for booking your make up session with Kweencindy make up services, we are glad to serve you. 
        Please payment link will be activated when your booking is accepted by our team";

        $data['messageAdmin'] = "You have received new booking from $event->name, 
        See booking details below, click button to accept or decline booking.";

        $data['cat'] = $event->category;
        $data['location'] = $event->location;
        $data['state'] = $event->state;
        $data['town'] = $event->town;
        $data['addr'] = $event->address;
        $data['bookDate'] = $event->book_date;

        // notify user that booked
        Mail::to($event->email)->send(new BookingSuccessfull($data));

        //notify system admin
        $allAdmin = User::where('is_admin', 1)->get();
        foreach($allAdmin as $admin){
            Mail::to($admin->email)->send(new BookedNotifyAdmin($data));
        }
        
    }

}
