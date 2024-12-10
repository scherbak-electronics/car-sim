<?php

namespace App\Contracts;

interface EngineInterface
{
    public function start(): void;

    public function stop(): void;
    public function isRunning(): bool;
}
