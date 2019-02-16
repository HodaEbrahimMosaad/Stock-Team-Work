<?php

namespace App\Console;

use App\Jobs\SendEmail;
use App\Mail\SendEmailMailable;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Mail;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //'App\Console\Commands\cronEmail'
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
//        $schedule->call( function() {
//            SendEmail::dispatch()->delay(now()->addSeconds(5));
//        })->everyMinute();
//       $schedule->job(new SendEmail)->everyMinute();

//        $schedule->call(function () {
//
//            SendEmail::dispatch()->delay(now()->addSeconds(5));
//        })->everyMinute();
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
