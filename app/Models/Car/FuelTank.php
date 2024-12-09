<?php
namespace App\Models\Car;

use App\Contracts\FuelTankInterface;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Psr\SimpleCache\InvalidArgumentException;

class FuelTank implements FuelTankInterface
{
    const CAPACITY = 50.0;
    const DEFAULT_FUEL_LEVEL = 10.0;
    const LOCKED_KEY = 'fuel_tank:locked';
    const FUEL_LEVEL_KEY = 'fuel_tank:fuel_level';

    public function addFuel(float $liters): string|float
    {
        if ($this->isLocked()) {
            return "Fuel door is locked.\n";
        }

        $level = $this->getFuelLevel() + $liters;
        if ($level > FuelTank::CAPACITY) {
            $level = FuelTank::CAPACITY;
        }
        $this->setFuelLevel($level);
        return $level;
    }

    public function consumeFuel(float $liters): float
    {
        $level = $this->getFuelLevel() - $liters;
        if ($level < 0) {
            $this->setFuelLevel(0.0);
            return 0.0;
        }
        $this->setFuelLevel($level);
        return $level;
    }

    public function getFuelLevel(): float
    {
        try {
            return Cache::store('redis')->get(
                FuelTank::FUEL_LEVEL_KEY,
                FuelTank::DEFAULT_FUEL_LEVEL
            );
        } catch (InvalidArgumentException $e) {
            Log::error("Error loading fuel level from Redis: " . $e->getMessage());
            return 0;
        }
    }

    public function isEmpty(): bool
    {
        return $this->getFuelLevel() < (FuelTank::CAPACITY * 0.05);
    }

    public function lock(): void
    {
        Cache::store('redis')->put(FuelTank::LOCKED_KEY, true);
    }

    /**
     * Unlock the fuel hatch.
     */
    public function unlock(): void
    {
        Cache::store('redis')->put(FuelTank::LOCKED_KEY, false);
    }

    public function isLocked(): bool
    {
        try {
            return Cache::store('redis')->get(FuelTank::LOCKED_KEY, true);
        } catch (InvalidArgumentException $e) {
            Log::error("Error loading locked state from Redis: " . $e->getMessage());
            return true;
        }
    }
    protected function setFuelLevel(float $level): void
    {
        Cache::store('redis')->put(FuelTank::FUEL_LEVEL_KEY, $level);
    }
}
