<?php
namespace App\Contracts;

interface EngineProcessorInterface
{
    public function startEngine(): void;      // Start the engine
    public function stopEngine(): void;       // Stop the engine

    public function getOdometerReading(): int; // Get the odometer reading
}
