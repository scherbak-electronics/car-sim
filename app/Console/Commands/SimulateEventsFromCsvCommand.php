<?php

namespace App\Console\Commands;

use App\Models\Driver;
use Illuminate\Console\Command;

class SimulateEventsFromCsvCommand extends Command
{
    protected $signature = 'car:simulate:csv {file}';
    protected $description = 'Simulate car events from a CSV file';

    public function handle(): void
    {
        $file = $this->argument('file');

        if (!file_exists($file)) {
            $this->error("File {$file} does not exist.");
            return;
        }

        $rows = array_map('str_getcsv', file($file));
        $driver = app(Driver::class);

        foreach ($rows as $row) {
            $eventName = $row[0];
            $payload = json_decode($row[1] ?? '{}', true);

            $driver->pleaseDo($eventName, $payload);
            $this->info("Event '{$eventName}' executed successfully.");
        }
    }
}
