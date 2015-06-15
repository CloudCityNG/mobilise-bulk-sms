<?php namespace App\Lib\Log;

//$logFileDirectoryAndName="/yourDirectory/yourFileName.xxx";
//$logger = new Logger($logFileDirectoryAndName);
//$logger->AddRow("Your Log Message");
//#log a system error and echo a message
//$logger->LogError(mysql_error($conn));
//$logger->Commit();

class Logger {

    protected $file;

    protected $content;

    protected $writeFlag;

    protected $endRow;

    /**
     * @param $file
     * @param string $endRow
     * @param int $writeFlag
     */
    public function __construct($file,$endRow="\n",$writeFlag=FILE_APPEND) {

        $this->file=$file;

        $this->writeFlag=$writeFlag;

        $this->endRow=$endRow;

    }


    /**
     * @param string $content
     * @param int $newLines
     */
    public function AddRow($content="",$newLines=1){

        $newRow="";
        $date = "[ " .date('Y-m-d H:i:s')."] ";
        for ($m=0;$m<$newLines;$m++)
        {

            $newRow .= $this->endRow;

        }

        $this->content .=  $date . "\t" . $content . $newRow;

    }


    /**
     * @return int
     */
    public function Commit(){

        return file_put_contents($this->file,$this->content,$this->writeFlag);

    }

    /**
     * @param $error
     * @param int $newLines
     */
    public function LogError($error,$newLines=1)
    {
        if ($error!=""){

            $this->AddRow($error,$newLines);
            echo $error;

        }
    }
}