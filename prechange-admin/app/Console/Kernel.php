<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\BalanceBTCUpdate::class,
        Commands\BalanceETHUpdate::class,

        Commands\BTCColdWallet::class,
        Commands\ETHColdWallet::class,
      
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('update:btc')->everyFiveMinutes();
        $schedule->command('update:eth')->everyFiveMinutes();
        
        $schedule->command('coldwallet:btc')->everyFiveMinutes();
        $schedule->command('coldwallet:eth')->everyFiveMinutes();
        
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
