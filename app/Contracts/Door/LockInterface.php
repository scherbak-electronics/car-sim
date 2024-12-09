<?php
namespace App\Contracts\Door;

interface LockInterface
{
    public function lock(): void;
    public function unlock(): void;
    public function isLocked(): bool;
}
