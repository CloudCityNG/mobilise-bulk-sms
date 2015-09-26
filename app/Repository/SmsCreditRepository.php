<?php namespace App\Repository;


use App\Lib\Services\Text\CharacterCounter;
use App\Models\Sms\SmsCredit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SmsCreditRepository {

    const UNIT_LOCAL = 1;
    const UNIT_INTL = 15;


    public static function createNewAccount($user)
    {
        if ( empty($user->smscredit->available_credit) )
            return $user->smscredit()->save( new SmsCredit() );
    }


    public static function getSmsBill($recipients, $message)
    {
        //set delimiters
        $delimiters = "/(,)+/";

        //split the numbers according to delimiters and put in an array
        $numbers = preg_split($delimiters, $recipients, null, PREG_SPLIT_NO_EMPTY);

        //replace + with null/empty
        $numbers = preg_replace("/(\+)+/", "",$numbers);

        //strip spaces and + out of the number array
        $numbers = array_map('trim', $numbers);

        //replace numbers that start with 07|08|09 with
        if ( count($numbers) > 0 )
        {
            $pattern = "/^(0)(7|8|9){1}([0-9]{9})/";
            $numbers = preg_replace($pattern, "234$2$3", array_unique($numbers));
            //dd($numbers);
        }


        //@TODO write a method or closure to calculate number of pages. use modulus % if a remainder occurs then its more than a page.
        $sms_pages = CharacterCounter::countPage($message)->pages;
        $total_units = 0.00;
        $unit_local = self::UNIT_LOCAL * $sms_pages;
        $unit_intl = self::UNIT_INTL * $sms_pages;

        //foreach recipients, make the appropriate addition
        foreach ( $numbers as $number )
        {

            if ( substr($number, 0, 3) == '234' )
            {
                $total_units = $total_units + $unit_local;
            } else {
                $total_units = $total_units + $unit_intl;
            }
        }
        //dd($total_units);
        return $total_units;
    }


    public static function billUser($units)
    {
        return DB::table('sms_credit')->where('user_id', Auth::user()->id)->decrement('available_credit', $units);
    }


    public static function recordCreditUsage($sms_history_id, $units, $comment="Sms Debit")
    {
        return DB::table('sms_credit_usage_history')->insert([
            'user_id'=>Auth::user()->id,
            'sms_history_id'=>$sms_history_id,
            'used_units'=>$units,
            'comment'=>$comment
        ]);
    }

} 