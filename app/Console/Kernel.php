<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('mq:consume')->everyMinute();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
    protected $middleware = [
        // ...
        \App\Http\Middleware\CorsMiddleware::class,
        \App\Http\Middleware\Cors::class,

    ];
    protected $middlewareGroups = [
        'web' => [
            // ...
            \App\Http\Middleware\VerifyCsrfToken::class,
        ],
        // ...
    ];
}
