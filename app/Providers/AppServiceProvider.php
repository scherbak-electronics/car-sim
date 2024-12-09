<?php

namespace App\Providers;

use App\Contracts\DoorInterface;
use App\Contracts\EngineInterface;
use App\Contracts\FuelTankInterface;
use App\Models\Car\Door;
use App\Models\Car\Engine;
use App\Models\Car\FuelTank;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(DoorInterface::class, Door::class);
        $this->app->bind(EngineInterface::class, Engine::class);
        $this->app->bind(FuelTankInterface::class, FuelTank::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
