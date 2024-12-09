<?php
namespace App\Models\Car;

use App\Contracts\EngineInterface;
use App\Contracts\EngineProcessorInterface;
use App\Contracts\FuelTankInterface;

class EngineProcessor implements EngineProcessorInterface
{
    const MIN_ALLOWED_FUEL_LEVEL = 0.02;
    const COLD_START_FUEL_CONSUMPTION = 0.000695;
    protected EngineInterface $engine;
    protected FuelTankInterface $fuelTank;

    protected int $odometer = 0; // Example odometer value

    public function __construct(EngineInterface $engine, FuelTankInterface $fuelTank)
    {
        $this->engine = $engine;
        $this->fuelTank = $fuelTank;
    }
    public function startEngine(): void
    {
        if ($this->engine->isRunning()) {
            echo "Engine is already running.\n";
            return;
        }

        if (!$this->checkFuel()) {
            echo "Cannot start the engine: No fuel.\n";
            return;
        }

        $this->fuelTank->lock();
        $this->engine->start();
        $this->fuelTank->consumeFuel(EngineProcessor::COLD_START_FUEL_CONSUMPTION);
    }

    public function stopEngine(): void
    {
        // TODO: Implement stopEngine() method.
    }

    public function getOdometerReading(): int
    {
        // TODO: Implement getOdometerReading() method.
    }

    public function drive()
    {

    }

    protected function checkFuel(): bool
    {
        $fuelLevel = $this->fuelTank->getFuelLevel();

        if ($fuelLevel <= EngineProcessor::MIN_ALLOWED_FUEL_LEVEL) {
            return false;
        }

        return true;
    }
}

