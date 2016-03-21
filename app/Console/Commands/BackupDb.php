<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class BackupDb extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backup:db';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command is used to back up the Database this App runs on.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $dbhost = env('DB_HOST');
        $dbuser = env('DB_USERNAME');
        $dbpass = env('DB_PASSWORD');
        $dbname = env('DB_DATABASE');

        $backup_path = storage_path("db_backups");

        if ( !is_dir( $backup_path ) )
            mkdir( $backup_path, 0777, true );

        $filename = 'db-'. date('d-m-Y', time()) . ".sql";
        $backup_file = storage_path("db_backups/$filename");

        $command = "mysqldump -h$dbhost -u$dbuser -p$dbpass $dbname > $backup_file";
        $result=exec($command,$output);

        if($result=='')
        {/* no output is good */
            $this->info('Backup successfull today: ' . date('d-m-Y H:i:s', time()));
        }
        else
        {/* we have something to log the output here*/
            $this->error('Backup Failed today: ' . date('d-m-Y H:i:s', time()));
        }
        return;
    }
}
