<?php
namespace App\Models\Car;

use App\Contracts\EngineInterface;
use App\Contracts\EngineProcessorInterface;
use App\Contracts\FuelTankInterface;
use App\Contracts\MediaPlayerInterface;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Psr\SimpleCache\InvalidArgumentException;

class EngineProcessor implements EngineProcessorInterface
{
    const MIN_ALLOWED_FUEL_LEVEL = 0.02;
    const COLD_START_FUEL_CONSUMPTION = 0.000695;
    const KM_PER_ONE_DRIVE = 25;
    const LITERS_PER_100KM = 10;
    const ODOMETER_KEY = 'engine_processor:odometer';

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

    public function getOdometerReading(): float
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

        //todo: calculate distance for odometer if fuel remains for less then one drive
        $this->fuelTank->consumeFuel(
            $this->calculateOneDriveConsumption()
        );
        $this->setOdometer(
            $this->getOdometer() + self::KM_PER_ONE_DRIVE
        );
        return []; //todo: return status
    }

    protected function checkFuel(): bool
    {
        $fuelLevel = $this->fuelTank->getFuelLevel();

        if ($fuelLevel <= EngineProcessor::MIN_ALLOWED_FUEL_LEVEL) {
            return false;
        }

        return true;
    }

    protected function calculateOneDriveConsumption(): float
    {
        return (self::KM_PER_ONE_DRIVE * self::LITERS_PER_100KM) / 100;
    }

    protected function setOdometer(float $distance): void
    {
        Cache::store('redis')->put(self::ODOMETER_KEY, $distance);
    }

    protected function getOdometer(): float
    {
        try {
            return Cache::store('redis')->get(self::ODOMETER_KEY, 0.0);
        } catch (InvalidArgumentException $e) {
            Log::error("Error: " . $e->getMessage());
            return 0.0;
        }
    }
}

