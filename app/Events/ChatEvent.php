<?php

namespace App\Events;

use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class ChatEvent implements ShouldBroadcast
{
    use SerializesModels;

    public $message;
    public $from_user;

    public function __construct($message, $from_user)
    {
        $this->message = $message;
        $this->from_user = $from_user;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('chat.' . $this->from_user);
    }
}
