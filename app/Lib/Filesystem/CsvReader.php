<?php
namespace App\Lib\Filesystem;


class CsvReader
{


    /**
     * Read a csv|txt file with MSISDN on a separate file.
     * @param $handle
     * @return array
     * @throws \Exception
     */
    public static function readCsvNewLine($handle)
    {
        if ( !is_file($handle) )
            Throw new \Exception('File not valid');
        $out = [];
        $file = file($handle);

        foreach ($file as $line):
            $out[] = str_replace(["\r\n", ",", " "], "", $line);
        endforeach;

        return $out;
    }


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
        if (is_file($fileHandle)) {
            $array = array_map('trim', file($fileHandle));
            return implode(",", $array);
        }
        throw New \Exception("File not valid");
    }


    public function csv_to_array($filename = '', $delimiter = ',')
    {
        if (!file_exists($filename) || !is_readable($filename))
            throw New \Exception("File not readable");;

        $header = ['sender','recipients','message','schedule','flash'];
        $data = array();
        if (($handle = fopen($filename, 'r')) !== FALSE) {
            while (($row = fgetcsv($handle, null, $delimiter)) !== FALSE) {
                if (!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }
        return $data;
    }
} 