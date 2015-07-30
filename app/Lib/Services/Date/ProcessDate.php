<?php
namespace App\Lib\Services\Date;


use Carbon\Carbon;

class ProcessDate {


    public static function processDateTime($date=null, $time=null)
    {
        $format = null;
        $datetime = null;
        $tz = 'Africa/Lagos';

        if ( empty($date) )
            return null;

        if ( is_null($time) || empty($time) ):
            $format = "Y-m-d";
            $datetime = $date;
        endif;

        $format = "Y-m-d H:i A";
        $datetime = "$date $time";

        $dt = Carbon::createFromFormat($format, $datetime, $tz);
        return $dt->toDateTimeString();
    }
} 