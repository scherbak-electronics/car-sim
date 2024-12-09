<?php
namespace App\Models;

use App\Events\DriverEvent;
use App\Services\EventResolver;

class Car
{
    protected EventResolver $resolver;

    public function __construct(EventResolver $resolver)
    {
        $this->resolver = $resolver;
    }

    /**
     * Handle the incoming DriverEvent.
     */
    public function handle(DriverEvent $event): array
    {
        // Pass the event name and payload to the resolver
        return $this->resolver->resolveAndExecute($event->eventName, $event->payload);
    }
}
