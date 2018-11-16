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
       'App\Console\Commands\JobAlert',
       'App\Console\Commands\JobCheckExpired',
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();

        //job alert daily
        $schedule->command('jobalert:users')
                 ->everyMinute();
                 //->daily();

        //job alert weekly
        $schedule->command('jobalert:users')
                 ->weeklyOn(1, '00:00');


        //check expired date job post
        $schedule->command('job_checkexpired:users')
                 ->weeklyOn(1, '00:00');
                 //->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
