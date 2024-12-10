<?php
namespace App\Models\Car;

use App\Contracts\MediaPlayerInterface;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Psr\SimpleCache\InvalidArgumentException;

class MediaPlayer implements MediaPlayerInterface
{

    const RADIO_KEY = 'media_player:radio';
    const CD_KEY = 'media_player:cd';
    const SPOTIFY_KEY = 'media_player:spotify';
    const POWER_KEY = 'media_player:power';

    public function radio(bool $listen): array|string
    {
        if (!$this->getData(self::POWER_KEY)) {
            return 'Error: there is no power, please turn on the car first.';
        }
        Cache::store('redis')->put(self::RADIO_KEY, $listen);
        return $this->getStatus();
    }

    public function cd(bool $play): array|string
    {
        if (!$this->getData(self::POWER_KEY)) {
            return 'Error: there is no power, please turn on the car first.';
        }
        Cache::store('redis')->put(self::CD_KEY, $play);
        return $this->getStatus();
    }

    public function spotify(bool $listen): array|string
    {
        if (!$this->getData(self::POWER_KEY)) {
            return 'Error: there is no power, please turn on the car first.';
        }
        Cache::store('redis')->put(self::SPOTIFY_KEY, $listen);
        return $this->getStatus();
    }

    public function getStatus(): array|string
    {
        if (!$this->getData(self::POWER_KEY)) {
            return 'Error: there is no power, please turn on the car first.';
        }
        return [
            'radio' => $this->getData(self::RADIO_KEY),
            'cd' => $this->getData(self::CD_KEY),
            'spotify' => $this->getData(self::SPOTIFY_KEY),
        ];
    }

    public function powerOn(): void
    {
        Cache::store('redis')->put(self::POWER_KEY, true);
    }

    public function powerOff(): void
    {
        Cache::store('redis')->put(self::POWER_KEY, false);
    }

    protected function getData(string $key): bool
    {
        try {
            return Cache::store('redis')->get($key, false);
        } catch (InvalidArgumentException $e) {
            Log::error("Error getting Spotify status: " . $e->getMessage());
            return false;
        }
    }
}

