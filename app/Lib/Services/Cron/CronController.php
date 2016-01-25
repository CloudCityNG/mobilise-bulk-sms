<?php

namespace App\Lib\Services\Cron;


class CronController
{


    public function DB_Backup()
    {
        $dbhost = env('DB_HOST');
        $dbuser = env('DB_USERNAME');
        $dbpass = env('DB_PASSWORD');
        $dbname = env('DB_DATABASE');

        $backup_path = storage_path("db_backups");

        if ( !is_dir( $backup_path ) )
            mkdir( $backup_path, 0777, true );

        $time = date('d-m-Y_H-i-s', time());
        $backup_file = storage_path("db_backups/$dbname-$time". ".sql");

        $command = "mysqldump -h$dbhost -u$dbuser -p$dbpass $dbname > $backup_file";
        $result=exec($command,$output);

        if($result=='')
        {/* no output is good */
            echo 'Backup successfull today: ' . date('d-m-Y H:i:s', time());
        }
        else
        {/* we have something to log the output here*/
            echo 'Backup Failed today: ' . date('d-m-Y H:i:s', time());
        }
        return;
    }
}
