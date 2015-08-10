<?php
namespace App\Lib\Filesystem;


class CsvReader
{


    public static function readCsv1($fileHandle)
    {
        if (is_file($fileHandle)):
            $csv = array_map('str_getcsv', file($fileHandle));
            //return $csv;
            return implode(",", $csv[0]);
        endif;
        throw New \Exception ("File not valid");
    }

    public static function readTxt($fileHandle)
    {
        if ( is_file($fileHandle) )
        {
            $array = array_map('trim', file($fileHandle));
            return implode(",", $array);
        }
        throw New \Exception("File not valid");
    }
} 