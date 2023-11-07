<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class PublishNotification implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $creator, $message;

    public function __construct($creator, $message)
    {
        $this->creator = $creator;
        $this->message = $message;
    }

    public function broadcastOn()
    {
        return ['new-notif'];
    }
}
