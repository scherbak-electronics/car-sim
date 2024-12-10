<?php
namespace App\Contracts;

interface DriverPanelInterface
{
    public function startCar(): array|string;
    public function stopCar(): array|string;
    public function driveCar(): array|string;
    public function radio(bool $data): array|string;
    public function cd(bool $data): array|string;
    public function spotify(bool $listen): array|string;
    public function lockDoors(string $side): array|string;
    public function unlockDoors(string $side): array|string;
}
