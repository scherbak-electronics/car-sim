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

    public function handle(DriverEvent $event): array
    {
        return $this->resolver->resolveAndExecute($event->eventName, $event->payload);
    }
}
