<?php
namespace App\Models;

use App\Events\DriverEvent;
use Illuminate\Support\Facades\Event;

class Driver
{
    public function pleaseDo(string $eventName, mixed $payload = null): void
    {
        $results = Event::dispatch(new DriverEvent($eventName, $payload));
    }
}
