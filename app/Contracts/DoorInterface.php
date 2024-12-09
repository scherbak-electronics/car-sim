<?php
namespace App\Contracts;

interface DoorInterface
{
    public function lock(): void;        // Lock the door
    public function unlock(): void;      // Unlock the door
    public function isLocked(): bool;    // Check if the door is locked
    public function open(): void;        // Open the door
    public function close(): void;       // Close the door
    public function isOpen(): bool;      // Check if the door is open
}
