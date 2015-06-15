<?php namespace App\Repository;


use App\Lib\Services\Text\CharacterCounter;
use App\Models\Sms\SmsCredit;

class SmsCreditRepository {

    const UNIT_LOCAL = 1;
    const UNIT_INTL = 15;


    public function createNewAccount($user)
    {
        if ( empty($user->smscredit->available_credit) )
            return $user->smscredit()->save( new SmsCredit() );
    }


    public static function getSmsBill($recipients, $message)
    {
        //process the recipients
        $delimiters = "/(,)+/";

        //split the numbers according to delimiters and put in an array
        $numbers = preg_split($delimiters, $recipients, null, PREG_SPLIT_NO_EMPTY);

        //replace + with null/empty
        $numbers = preg_replace("/(\+)+/", "",$numbers);

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
            if ( strlen($number) == 13 )
            {
                $total_units = $total_units + $unit_local ;
            } else {
                $total_units = $total_units + $unit_intl;
            }
        }

        return $total_units;
    }

} 