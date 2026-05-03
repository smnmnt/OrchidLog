<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class PrepareProduction extends Command
{
    protected $signature = 'site:prepare-production
        {--skip-composer : Do not run composer dump-autoload --optimize}
        {--keep-app-cache : Do not clear the configured application cache store}';

    protected $description = 'Clear old caches and build optimized caches for production';

    public function handle(): int
    {
        $this->info('Preparing site for production...');

        if ($this->call('site:clear-cache', [
            '--keep-app-cache' => $this->option('keep-app-cache'),
        ]) !== self::SUCCESS) {
            return self::FAILURE;
        }

        if (! $this->option('skip-composer') && ! $this->dumpOptimizedAutoload()) {
            return self::FAILURE;
        }

        $commands = [
            'config:cache',
            'event:cache',
            'route:cache',
            'view:cache',
        ];

        foreach ($commands as $command) {
            $ok = $this->call($command) === self::SUCCESS;

            if (! $ok) {
                $this->error("Command failed: {$command}");

                return self::FAILURE;
            }
        }

        $this->newLine();
        $this->info('Production caches are ready.');

        return self::SUCCESS;
    }

    private function dumpOptimizedAutoload(): bool
    {
        $ok = true;

        $this->components->task('composer dump-autoload --optimize', function () use (&$ok) {
            $process = new Process(['composer', 'dump-autoload', '--optimize'], base_path());
            $process->setTimeout(120);
            $process->run();

            if (! $process->isSuccessful()) {
                $ok = false;

                $this->newLine();
                $this->error(trim($process->getErrorOutput() ?: $process->getOutput()));

                return false;
            }

            return true;
        });

        return $ok;
    }
}
