<?php
namespace App\Contracts;

interface MediaPlayerInterface
{
    public function radio(bool $listen): void;
    public function cd(bool $play): void;
    public function spotify(bool $listen): void;
    public function getStatus(): array; // [isPlaying, source]
}

