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

    public function startCar(array $data): void
    {
        $this->engineProcessor->startEngine();
    }

    public function stopCar(array $data): void
    {
        $this->engineProcessor->stopEngine();
    }

    public function driveCar(array $data): void
    {
        $this->engineProcessor->drive();
    }

    public function unlockDoors(array $data): void
    {
        $this->door->unlock();
    }

    public function lockDoors(array $data): void
    {
        $this->door->lock();
    }

    public function radio(array $data): void
    {
        $this->mediaPlayer->radio(
            data_get($data, 'listen', false)
        );
    }

    public function cd(array $data): void
    {
        $this->mediaPlayer->cd(
            data_get($data, 'play', false)
        );
    }

    public function spotify(array $data): void
    {
        $this->mediaPlayer->spotify(
            data_get($data, 'listen', false)
        );
    }
}
