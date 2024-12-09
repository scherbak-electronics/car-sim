<?php

use App\Contracts\DoorInterface;
use App\Contracts\DriverPanelInterface;
use App\Contracts\FuelTankInterface;

return [
    // Door Events
    'driver-unlocks-doors' => [
        'interface' => DoorInterface::class,
        'method' => 'unlock',
    ],
    'driver-locks-doors' => [
        'interface' => DoorInterface::class,
        'method' => 'lock',
    ],
    'driver-lowers-windows' => [
        'interface' => DoorInterface::class,
        'method' => 'lower',
    ],
    'driver-raises-windows' => [
        'interface' => DoorInterface::class,
        'method' => 'raise',
    ],

    // Driver Panel Events
    'driver-turns-car-on' => [
        'interface' => DriverPanelInterface::class,
        'method' => 'startCar',
    ],
    'driver-turns-car-off' => [
        'interface' => DriverPanelInterface::class,
        'method' => 'stopCar',
    ],
    'driver-listen-radio' => [
        'interface' => DriverPanelInterface::class,
        'method' => 'radio',
    ],
    'driver-listen-cd' => [
        'interface' => DriverPanelInterface::class,
        'method' => 'cd',
    ],
    'driver-listen-spotify' => [
        'interface' => DriverPanelInterface::class,
        'method' => 'spotify',
    ],
    'drive' => [
        'interface' => DriverPanelInterface::class,
        'method' => 'drive',
    ],

    // Fuel Tank Events
    'add-fuel' => [
        'interface' => FuelTankInterface::class,
        'method' => 'addFuel',
    ],
];
