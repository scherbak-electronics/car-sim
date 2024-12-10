<?php
namespace App\Models\Car;

use App\Contracts\EngineInterface;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Psr\SimpleCache\InvalidArgumentException;

class Engine implements EngineInterface
{
    const RUNNING_KEY = 'engine:running';
    public function start(): void
    {
        Cache::store('redis')->put(self::RUNNING_KEY, true);
    }

    public function stop(): void
    {
        Cache::store('redis')->put(self::RUNNING_KEY, false);
    }

    public function isRunning(): bool
    {
        try {
            return Cache::store('redis')->get(self::RUNNING_KEY, false);
        } catch (InvalidArgumentException $e) {
            Log::error("Error: " . $e->getMessage());
            return false;
        }
    }
}
