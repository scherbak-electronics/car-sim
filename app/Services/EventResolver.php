<?php
namespace App\Services;

use Illuminate\Contracts\Container\Container;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

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
    public function resolveAndExecute(string $eventName, mixed $payload = null)
    {
        $mapping = Config::get("event_resolver.{$eventName}");

        if (!$mapping) {
            throw new \InvalidArgumentException("No mapping found for event: {$eventName}");
        }

        $interface = $mapping['interface'] ?? null;
        $method = $mapping['method'] ?? null;
        $rules = $mapping['validation_rules'] ?? '';

        if (!$interface || !$method) {
            throw new \InvalidArgumentException("Invalid mapping configuration for event: {$eventName}");
        }

        if (!empty($rules)) {
            $payload = $this->getValidated($eventName, $payload, $rules);
        }

        $implementation = $this->container->make($interface);

        if (!method_exists($implementation, $method)) {
            throw new \BadMethodCallException("Method {$method} does not exist on the class implementing {$interface}.");
        }

        return call_user_func_array([$implementation, $method], $payload);
    }

    protected function getValidated(string $event, mixed $payload, string $rules): mixed
    {
        if (!$rules) {
            return $payload;
        }

        $validator = Validator::make(
            [$event => $payload ?? null],
            [$event => $rules]
        );

        try {
            return $validator->validated()['value'];
        } catch (\Exception $e) {
            Log::error("Validation error for event '{$event}': " . $e->getMessage());
            return null;
        }
    }
}
