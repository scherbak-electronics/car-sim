<?php
namespace App\Contracts;

interface DriverPanelInterface
{
    public function startCar(array $data): void;                // Start the car
    public function stopCar(array $data): void;                 // Stop the car
    public function driveCar(array $data): void;                // Drive the car
    public function radio(array $data): void;
    public function cd(array $data): void;
    public function spotify(array $data): void;
    public function lockDoors(array $data): void;
    public function unlockDoors(array $data): void;
}
