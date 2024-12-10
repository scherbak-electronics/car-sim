<?php
namespace App\Models;

use App\Events\DriverEvent;
use Illuminate\Support\Facades\Event;

class Driver
{
    public function pleaseDo(string $eventName, mixed $payload = null): array|string
    {
        $result = Event::dispatch(new DriverEvent($eventName, $payload));
        if (is_array($result) || is_string($result)) {
            return $result;
        }
        return [];
    }
}
