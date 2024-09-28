<?php

namespace App\Console;

use App\Models\Reminder;
use App\Models\Invoice;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\DailyQuote::class,
        Commands\ReminderMail::class,
        Commands\ThirdReminder::class,
    ];
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('unpaid:reminder-mail2')->dailyAt('08:00'); // DailyQuote  -- first reminder
        $schedule->command('unpaid:reminder-mail')->dailyAt('08:00');  // ReminderMail  -- second reminder
        $schedule->command('unpaid:third-reminder')->dailyAt('08:00'); // ThirdReminder  -- third reminder
    }
    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');
        require base_path('routes/console.php');
    }

    
}
