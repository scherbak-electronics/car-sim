<?php
namespace App\Models\Car;

use App\Contracts\DoorInterface;
use App\Contracts\DriverPanelInterface;
use App\Contracts\EngineProcessorInterface;
use App\Contracts\FuelTankInterface;
use App\Contracts\MediaPlayerInterface;

class DriverPanel implements DriverPanelInterface
{
    protected DoorInterface $door;
    protected EngineProcessorInterface $engineProcessor;
    protected FuelTankInterface $fuelTank;
    protected MediaPlayerInterface $mediaPlayer;

    public function __construct(
        DoorInterface $door,
        EngineProcessorInterface $engineProcessor,
        FuelTankInterface $fuelTank,
        MediaPlayerInterface $mediaPlayer
    ) {
        $this->door = $door;
        $this->engineProcessor = $engineProcessor;
        $this->fuelTank = $fuelTank;
        $this->mediaPlayer = $mediaPlayer;
    }

    public function startCar(): array|string
    {
        return $this->engineProcessor->startEngine();
    }

    public function stopCar(): array|string
    {
        return $this->engineProcessor->stopEngine();
    }

    public function driveCar(): array|string
    {
        return $this->engineProcessor->drive();
    }

    public function unlockDoors(string $side): array|string
    {
        $this->door->unlock();
    }

    public function lockDoors(string $side): array|string
    {
        $this->door->lock();
    }

    public function radio(bool $listen): array|string
    {
        return $this->mediaPlayer->radio($listen);
    }

    public function cd(bool $listen): array|string
    {
        return $this->mediaPlayer->cd($listen);
    }

    public function spotify(bool $listen): array|string
    {
        return $this->mediaPlayer->spotify($listen);
    }
}
