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
       'App\Console\Commands\JobDailyAlert',
       'App\Console\Commands\JobWeeklyAlert',
       'App\Console\Commands\JobCheckExpired',
       'App\Console\Commands\RegisteredUsers',
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
        $schedule->command('jobalertdaily:users')
                 //->everyMinute();
                 ->daily();
        
        //Run the task every week on Monday at 8:00
        //job alert weekly
        $schedule->command('jobalertweekly:users')
                 ->weeklyOn(1, '8:00'); 
 
        //check expired date job post
        $schedule->command('job_checkexpired:users')
                 ->weeklyOn(1, '8:00');
        
        //Run the task every week on Friday at 17:00
        //registered users
        $schedule->command('registered:users')
                 ->weeklyOn(5, '17:00');
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
