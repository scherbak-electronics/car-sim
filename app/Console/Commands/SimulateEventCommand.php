<?php

namespace App\Console\Commands;

use App\Models\Driver;
use Illuminate\Console\Command;

class SimulateEventCommand extends Command
{
    protected $signature = 'car:simulate {event} {value?}';
    protected $description = 'Send car simulation event.';

    public function handle(): void
    {
        $event = $this->argument('event');
        $value = $this->argument('value') ?? null;

        try {
            $driver = app(Driver::class);
            $result = $driver->pleaseDo($event, $value);
            $this->info("Result: '{$result}'");
        } catch (\Exception $e) {
            $this->error("Error executing event '{$event}': " . $e->getMessage());
        }
    }
}
