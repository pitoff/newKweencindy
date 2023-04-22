<?php

namespace App\Events;

use App\Models\Booking;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MakeupBooked
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $email;
    public $category;
    public $location;
    public $state;
    public $town;
    public $book_date;
    public $address;
    public $name;
    public $book_time;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($email, $name, $category, $location, $state, $town, $address, $book_date, $book_time)
    {
        $this->email = $email;
        $this->name = $name;
        $this->category = $category;
        $this->location = $location;
        $this->state = $state;
        $this->town = $town;
        $this->address = $address;
        $this->book_date = $book_date;
        $this->book_time = $book_time;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
