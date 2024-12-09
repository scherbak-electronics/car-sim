<?php

namespace App\Contracts;

interface EngineInterface
{
    public function startEngine(): void;      // Start the engine

    public function stopEngine(): void;       // Stop the engine

    public function processEvent(string $event, array $data = []): void; // Process a single event

    public function getOdometerReading(): int; // Get the odometer reading
}
