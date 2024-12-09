<?php
namespace App\Services;

use Illuminate\Contracts\Container\Container;
use Illuminate\Support\Facades\Config;

class EventResolver
{
    protected Container $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * Resolve and execute the event.
     */
    public function resolveAndExecute(string $eventName, array $payload = [])
    {
        // Fetch the event mapping from the config
        $mapping = Config::get("event_resolver.{$eventName}");

        if (!$mapping) {
            throw new \InvalidArgumentException("No mapping found for event: {$eventName}");
        }

        $interface = $mapping['interface'] ?? null;
        $method = $mapping['method'] ?? null;

        if (!$interface || !$method) {
            throw new \InvalidArgumentException("Invalid mapping configuration for event: {$eventName}");
        }

        // Resolve the class implementing the interface
        $implementation = $this->container->make($interface);

        // Ensure the method exists on the resolved class
        if (!method_exists($implementation, $method)) {
            throw new \BadMethodCallException("Method {$method} does not exist on the class implementing {$interface}.");
        }

        // Call the method dynamically
        return call_user_func_array([$implementation, $method], $payload);
    }
}
