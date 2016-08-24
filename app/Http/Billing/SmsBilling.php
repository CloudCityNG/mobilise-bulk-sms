<?php

namespace App\Http\Billing;


use App\Lib\Services\PhoneNumber\PhoneUtil;
use App\Lib\Services\Text\CharacterCounter;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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


    public function getSmsUnitBill($recipients, $message)
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

        return $total_units * $sms_pages;
    }


    public function billUserUnits($units, $user_id)
    {
        return DB::table('sms_credit')
            ->where('user_id', $user_id)
            ->decrement('available_credit', $units,[
                'updated_at' => Carbon::now(),
            ]);
    }


    public function logBillUnits($units, $user_id, $smsHistoryId=null)
    {
        return DB::table('sms_credit_usage_history')
            ->insert([
                'user_id' => $user_id,
                'sms_history_id' => $smsHistoryId,
                'used_units' => $units,
                'comment' => 'User Sms Debit',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
    }

}