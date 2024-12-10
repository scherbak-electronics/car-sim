<?php
namespace App\Contracts;

interface MediaPlayerInterface
{
    public function radio(bool $listen): array|string;
    public function cd(bool $play): array|string;
    public function spotify(bool $listen): array|string;
    public function getStatus(): array|string;
    public function powerOn(): void;
    public function powerOff(): void;
}

