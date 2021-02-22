<?php

namespace App\Console;

use App\Console\Commands\SendNewsletter;
use Carbon\Carbon;
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
        SendNewsletter::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $now = Carbon::now();
        $month = $now->format('F');
        $year = $now->format('Y');

        $secondTuesdayMonthly = new Carbon('Second Tuesdays of ' . $month . ' ' . $year);

        $schedule->command('send:newsletters')
            ->monthlyOn($secondTuesdayMonthly->format('d'));
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
