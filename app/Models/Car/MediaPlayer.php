<?php
namespace App\Models\Car;

use App\Contracts\MediaPlayerInterface;

class MediaPlayer implements MediaPlayerInterface
{

    public function radio(bool $listen): void
    {
        // TODO: Implement play() method.
    }

    public function cd(bool $play): void
    {
        // TODO: Implement pause() method.
    }

    public function spotify(bool $listen): void
    {
        // TODO: Implement stop() method.
    }

    public function getStatus(): array
    {
        return [];
    }
}

