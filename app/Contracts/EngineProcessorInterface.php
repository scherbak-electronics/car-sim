<?php
namespace App\Contracts;

interface EngineProcessorInterface
{
    public function startEngine(): array|string;      // Start the engine
    public function stopEngine(): array|string;       // Stop the engine

    public function getOdometerReading(): int; // Get the odometer reading
}
