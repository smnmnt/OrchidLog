<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Throwable;

class ClearSiteCache extends Command
{
    protected $signature = 'site:clear-cache
        {--keep-app-cache : Do not clear the configured application cache store}';

    protected $description = 'Clear all framework caches used by the site';

    public function handle(): int
    {
        $this->info('Clearing site caches...');

        $commands = [
            'config:clear',
            'route:clear',
            'view:clear',
            'event:clear',
            'clear-compiled',
        ];

        if (! $this->option('keep-app-cache')) {
            $commands[] = 'cache:clear';
        }

        foreach ($commands as $command) {
            $exception = null;

            try {
                $ok = $this->callSilent($command) === self::SUCCESS;
            } catch (Throwable $exception) {
                $ok = false;
            }

            $this->components->task($command, fn () => $ok);

            if (! $ok) {
                $this->error("Command failed: {$command}");

                if (isset($exception)) {
                    $this->line($exception->getMessage());
                }

                return self::FAILURE;
            }
        }

        $this->newLine();
        $this->info('Caches cleared.');

        return self::SUCCESS;
    }
}
