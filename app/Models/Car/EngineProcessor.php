<?php
namespace App\Models\Car;

use App\Contracts\EngineInterface;
use App\Contracts\EngineProcessorInterface;
use App\Contracts\FuelTankInterface;
use App\Contracts\MediaPlayerInterface;

class EngineProcessor implements EngineProcessorInterface
{
    const MIN_ALLOWED_FUEL_LEVEL = 0.02;
    const COLD_START_FUEL_CONSUMPTION = 0.000695;
    protected EngineInterface $engine;
    protected FuelTankInterface $fuelTank;
    protected MediaPlayerInterface $mediaPlayer;

    protected int $odometer = 0; // Example odometer value

    public function __construct(
        EngineInterface $engine,
        FuelTankInterface $fuelTank,
        MediaPlayerInterface $mediaPlayer
    )
    {
        $this->engine = $engine;
        $this->fuelTank = $fuelTank;
        $this->mediaPlayer = $mediaPlayer;
    }
    public function startEngine(): array|string
    {
        if ($this->engine->isRunning()) {
            return "Engine is already running.\n";
        }

        if (!$this->checkFuel()) {
            return "Cannot start the engine: No fuel.\n";
        }

        $this->fuelTank->lock();
        $this->engine->start();
        $this->mediaPlayer->powerOn();
        $this->fuelTank->consumeFuel(EngineProcessor::COLD_START_FUEL_CONSUMPTION);
        return [];
    }

    public function stopEngine(): array|string
    {
        if (!$this->engine->isRunning()) {
            return "Engine is not running.\n";
        }
        $this->fuelTank->unlock();
        $this->engine->stop();
        $this->mediaPlayer->powerOff();
        return [];
    }

    public function getOdometerReading(): int
    {
        return 0;
    }

    public function drive(): array|string
    {
        if (!$this->engine->isRunning()) {
            return "Engine is not running.\n";
        }
        if (!$this->checkFuel()) {
            $this->stopEngine();
            return "Cannot drive the car: No fuel.\n";
        }
        return [];
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

