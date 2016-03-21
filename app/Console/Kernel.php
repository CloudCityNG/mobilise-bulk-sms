<?php namespace App\Console;

use App\Lib\Log\Logger;
use App\Lib\Services\Cron\CronController;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel {

	/**
	 * The Artisan commands provided by your application.
	 *
	 * @var array
	 */
	protected $commands = [
		'App\Console\Commands\Inspire',
        Commands\BackupDb::class,
	];

	/**
	 * Define the application's command schedule.
	 *
	 * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
	 * @return void
	 */
	protected function schedule(Schedule $schedule)
	{
		$schedule->command('inspire')
				 ->hourly();


        /**
         * Run cron twice at 12pm and 4pm
         * To backup this project's MySQL database
         */
        $schedule->call(function(CronController $controller){
            $controller->DB_Backup();
        })->twiceDaily(12, 16);

	}

}
