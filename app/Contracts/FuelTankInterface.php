<?php
namespace App\Contracts;

interface FuelTankInterface
{
    public function addFuel(float $liters): float|string;
    public function consumeFuel(float $liters): float;
    public function getFuelLevel(): float;
    public function isEmpty(): bool;
    public function lock(): void;
    public function unlock(): void;
    public function isLocked(): bool;
}
