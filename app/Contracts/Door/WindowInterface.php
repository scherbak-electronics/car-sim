<?php
namespace App\Contracts\Door;

interface WindowInterface
{
    public function open(): void;
    public function close(): void;
    public function getStatus(): int; // Percentage open
}
