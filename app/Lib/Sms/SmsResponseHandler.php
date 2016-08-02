<?php
namespace App\Lib\Sms;


use App\Models\Sms\SmsHistory;
use App\Models\Sms\SmsHistoryRecipient;
use App\User;

class SmsResponseHandler
{


    private $response;
    /**
     * @var
     */
    private $smsHistory;
    /**
     * @var
     */
    private $smsHistoryRecipient;
    private $sender;
    private $message;
    private $schedule;
    private $units;
    private $flash;
    private $user_id;
    /**
     * @var array
     */

    /**
     * SmsResponseHandler constructor.
     * @param $response
     */
    public function __construct(SmsHistory $smsHistory, SmsHistoryRecipient $smsHistoryRecipient)
    {

        $this->smsHistory = $smsHistory;
        $this->smsHistoryRecipient = $smsHistoryRecipient;
    }


    function process($response)
    {
        $s = json_decode($response);

        $user = User::find($this->user_id);
        $sms_history = $this->smsHistory->store($this->sender, $this->message, $this->schedule, $this->units, $this->flash);
        $sms_history_row = $user->smshistory()->save( $sms_history );

        $recipients = [];

        //update the recipients table
        foreach ( $s['results'] as $result ):
            $recipients[] = $this->smsHistoryRecipient->store($result['status'], $result['messageid'], $result['destination']);
        endforeach;

        $s = $this->smsHistory->find($sms_history_row->id);
        $s->smsHistoryRecipient()->saveMany($recipients);
    }


    public function __get($name)
    {
        if ($this->values[$name]):
            return $this->values[$name];
        endif;
    }


    public function prepareInputs(Array $inputs)
    {
        $this->sender = $inputs['sender'];
        $this->message = $inputs['message'];
        $this->schedule = $inputs['schedule'];
        $this->units = $inputs['units'];
        $this->flash = $inputs['flash'];
        $this->user_id = $inputs['user_id'];
    }
}