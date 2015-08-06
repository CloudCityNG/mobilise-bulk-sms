<?php
namespace App\Repository;


use App\Models\Sms\SmsHistory;
use Illuminate\Support\Facades\Auth;

class SmsHistoryRepository {

    const UNIT_LOCAL = 1;
    const UNIT_INTL = 15;
    const DEFAULT_PAGINATE_SIZE = 10;



    function __construct()
    {

    }

//    public function save(SentSmsHistory $smsHistory, $userId)
//    {
//        return User::findOrFail($userId)
//            ->sentsms()->save($smsHistory);
//    }


    /**
     * Paginate the sent sms record
     * @param $userId
     * @param int $per_page
     * @return mixed
     */

    public function paginate($per_page=self::DEFAULT_PAGINATE_SIZE)
    {
        return Auth::user()->sentsms()->with('user')->latest()->paginate($per_page);
        //return SentSmsHistory::where('user_id', '=', $userId)->paginate($per_page);
    }


    /**@TODO migrate code here to sms_credit repository/model
     * Get total credit units for user
     * @param $recipients
     * @param $message
     * @return int
     */
    public static function getBill($recipients, $message)
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
        $sms_pages = ceil( strlen($message) / 160.00 );
        $total_units = 0;
        $unit_local = self::UNIT_LOCAL * $sms_pages;
        $unit_intl = self::UNIT_INTL * $sms_pages;

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


    public function del($id)
    {
        if ( Auth::user()->smshistory()->where('id', $id)->count() )
        {
            //delete corresponding row from sms_history_recipients
            SmsHistory::find($id)->smsHistoryRecipient()->delete();
            return Auth::user()->smshistory()->where('id', $id)->delete();
        }
        return false;
    }


    /**
     * Get a record of all sent SMS with SMSHistory model record
     * @return mixed
     */
    public function sentSms()
    {
        return Auth::user()->smshistory()->with('smshistoryrecipient')->orderBy('created_at', 'descending')->paginate(self::DEFAULT_PAGINATE_SIZE);
        //return SmsHistory::where('user_id', Auth::user()->id)->with('smshistoryrecipient')->orderBy('created_at', 'descending')->get();
    }


    public function getDlr($id)
    {
        return Auth::User()->smshistory()->where('id',$id)->with('smshistoryrecipient')->get();
    }


    public function sentSmsId($id)
    {
        return SmsHistory::where('user_id', Auth::user()->id)
            ->where('id', $id)
            ->with('smshistoryrecipient')->get();
    }



} 