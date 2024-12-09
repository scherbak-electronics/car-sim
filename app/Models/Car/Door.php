<?php
namespace App\Models\Car;

use App\Contracts\DoorInterface;
use App\Contracts\EngineProcessorInterface;
use App\Contracts\FuelTankInterface;
use App\Contracts\MediaPlayerInterface;

class Door implements DoorInterface
{
    public function unlock(): void
    {
        echo "Doors unlocked.\n";
    }

    public function lock(): void
    {
        echo "Doors locked.\n";
    }

    public function isLocked(): bool
    {
        // TODO: Implement isLocked() method.
    }

    public function open(): void
    {
        // TODO: Implement open() method.
    }

    public function close(): void
    {
        // TODO: Implement close() method.
    }

    public function isOpen(): bool
    {
        // TODO: Implement isOpen() method.
    }
}
