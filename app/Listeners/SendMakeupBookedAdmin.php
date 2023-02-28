<?php

namespace App\Listeners;

use App\Events\MakeupBookedAdmin;
use App\Mail\BookedNotifyAdmin;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendMakeupBookedAdmin implements ShouldQueue
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
     * @param  object  $event
     * @return void
     */
    public function handle(MakeupBookedAdmin $event)
    {
        
        $data['messageAdmin'] = "You have received new booking from $event->name, 
        See booking details below, click button to accept or decline booking.";

        $data['cat'] = $event->category;
        $data['location'] = $event->location;
        $data['state'] = $event->state;
        $data['town'] = $event->town;
        $data['addr'] = $event->address;
        $data['bookDate'] = $event->book_date;

        // notify system admin
        $allAdmin = User::where('role', User::ADMIN)->get();
        foreach($allAdmin as $admin){
            Mail::to($admin->email)->send(new BookedNotifyAdmin($data));
        }
    }
}
