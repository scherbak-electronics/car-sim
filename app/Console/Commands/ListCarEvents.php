<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;

class ListCarEvents extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'car:events:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List all available car events';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $events = Config::get('event_resolver', []);

        $this->info("Available Car Events:");
        foreach ($events as $event => $details) {
            $rules = $details['validation_rules'] ?? null;
            $this->line("  - {$event}" . ($rules ? " ({$rules})" : ""));
        }

        return 0;
    }
}
