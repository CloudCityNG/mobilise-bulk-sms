<?php

namespace App\Http\Billing;


use App\Lib\Services\PhoneNumber\PhoneUtil;
use App\Lib\Services\Text\CharacterCounter;

class SmsBilling
{

    const UNITS = 1;
    /**
     * @var PhoneUtil
     */
    private $phoneUtil;


    public function __construct(PhoneUtil $phoneUtil)
    {

        $this->phoneUtil = $phoneUtil;
    }


    public function createNewSmsAccount(User $user)
    {
        if ( empty($user->smscredit->available_credit) ):
            return $user->smscredit()->save( new SmsCredit() );
        endif;
    }


    public function getSmsBill($recipients, $message)
    {
        //set delimiters
        $delimiters = "/(,)+/";

        //split numbers
        $numbers = preg_split($delimiters, $recipients, null, PREG_SPLIT_NO_EMPTY);

        //remove + sign
        $numbers = preg_replace("/(\+)+/", "", $numbers);

        //remove spaces
        $numbers = array_map("trim", $numbers);

        //replace numbers that start with 07|08|09 with 23470|23480|23490
        $pattern = "/^(0)(7|8|9){1}([0-9]{9})/";
        $numbers = preg_replace($pattern, "234$2$3", array_unique($numbers));

        $sms_pages = CharacterCounter::countPage($message)->pages;
        $total_units = 0.00;

        foreach ( $numbers as $number ):
            $this->phoneUtil->number($number);
            if( $this->phoneUtil->isValid() ):
                $total_units += $this->phoneUtil->getChargeByDialingCode();
            endif;
        endforeach;

        return $total_units;


    }

}