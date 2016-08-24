<?php
namespace App\Repository;

use App\Models\Dlr;
use App\Models\Sms\SmsHistory;
use App\User;
use Illuminate\Support\Facades\Auth;

class SmsHistoryRepository {

    const UNIT_LOCAL = 1;
    const UNIT_INTL = 15;
    const DEFAULT_PAGINATE_SIZE = 10;


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


    /**
     * Delete a (sms_history) row
     * @param $id
     * @param $user_id
     * @return bool
     */
    public function del($id)
    {
        $recipient = Auth::user()->smshistoryrecipient()->where('sms_history_id', $id);
        $recipient_row = $recipient->get();

        if ( $recipient_row ) {
            //iterate over the recipients rows
            foreach ($recipient_row as $row) {
                //if messageid exists
                if ($row->messageid) {
                    //delete row in sms_dlr
                    Dlr::where('messageid', $row->messageid)->delete();
                }
            }
            //delete row in sms_history_recipients
            $recipient->delete();
        }
        //delete sms_history row
        Auth::user()->smshistory->find($id)->delete();
    }


    /**
     * Get a paginated record of all sent SMS with SMSHistory model record
     * @return mixed
     */
    public function sentSms()
    {
            return Auth::user()->smshistory()->with('smshistoryrecipient')->orderBy('created_at', 'descending')->paginate(self::DEFAULT_PAGINATE_SIZE);
    }


    /**
     * Get Delivery report for sms_history record via smshistoryrecipient
     * @param $id
     * @return mixed
     */
    public function getDlr($id)
    {
        return Auth::user()->smshistory()->where('id',$id)->with('smshistoryrecipient')->get();
    }


    public function getSentSms($id)
    {
        return Auth::user()->smshistory()->where('id',$id)->with('smshistoryrecipient');
    }


    public function sentSmsId($id, $withHistoryRecipient=true)
    {
        $out = Auth::user()->smshistory()->where('id', $id);

        if( $withHistoryRecipient )
            return $out->with('smshistoryrecipient')->first();
        else
            return $out->first();
    }
} 