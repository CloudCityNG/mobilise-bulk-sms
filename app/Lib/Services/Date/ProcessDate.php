<?php
namespace App\Lib\Services\Date;


use Carbon\Carbon;

class ProcessDate {


    public static function dateDifference($date_1, $date_2, $differenceFormat="%ad%hh%im")
    {
        $datetime1 = date_create($date_1);
        $datetime2 = date_create($date_2);

        $interval = date_diff($datetime1, $datetime2);
        return $interval->format($differenceFormat);
    }


    public static function processDateTime($date=null, $time=null)
    {
        $format = null;
        $datetime = null;

        if ( empty($date) )
            return null;

        if ( is_null($time) || empty($time) ):
            $format = "Y-m-d";
            $datetime = $date;
        endif;

        $format = "Y-m-d H:i A";
        $datetime = "$date $time";

        $dt = Carbon::createFromFormat($format, $datetime);
        return $dt->toDateTimeString();
    }
} 