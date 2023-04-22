<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MakeupBookedAdmin
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $name;
    public $category;
    public $location;
    public $state;
    public $town;
    public $address;
    public $book_date;
    public $book_time;

    public function __construct($name, $category, $location, $state, $town, $address, $book_date, $book_time)
    {
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
