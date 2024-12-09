<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DriverEvent
{
    use Dispatchable;

    public string $eventName;
    public mixed $payload;

    public function __construct(string $eventName, mixed $payload = null)
    {
        $this->eventName = $eventName;
        $this->payload = $payload;
    }
}
