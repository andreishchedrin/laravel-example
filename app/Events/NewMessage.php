<?php

namespace AttendanceSystem\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $id;
    public $message_id;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($message, $id, $message_id)
    {
        $this->message = $message;
        $this->id = $id;
        $this->message_id = $message_id;
//        $this->dontBroadcastToCurrentUser();
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return [new PrivateChannel('direct.'.auth()->user()->id), new PrivateChannel('direct.'.$this->id)];
    }

}
