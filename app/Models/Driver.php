<?php
namespace App\Models;

use App\Events\DriverEvent;
use Illuminate\Support\Facades\Event;

class Driver
{
    public function pleaseDo(string $eventName, array $payload = []): void
    {
        // Dispatch an event
        //event(new DriverEvent($eventName, $payload));
        $results = Event::dispatch(new DriverEvent($eventName, $payload));
    }
}
