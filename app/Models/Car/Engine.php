<?php
namespace App\Models\Car;

use App\Contracts\EngineInterface;

class Engine implements EngineInterface
{
    public function start(): void
    {
        echo "Engine started.\n";
    }

    public function stop(): void
    {
        echo "Engine stopped.\n";
    }

    public function startEngine(): void
    {
        // TODO: Implement startEngine() method.
    }

    public function stopEngine(): void
    {
        // TODO: Implement stopEngine() method.
    }

    public function processEvent(string $event, array $data = []): void
    {
        // TODO: Implement processEvent() method.
    }

    public function getOdometerReading(): int
    {
        // TODO: Implement getOdometerReading() method.
    }
}
