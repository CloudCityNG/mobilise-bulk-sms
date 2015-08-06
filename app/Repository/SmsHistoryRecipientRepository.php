<?php
namespace App\Repository;


use App\Models\Sms\SmsHistory;

class SmsHistoryRecipientRepository {


    /**
     * @var SmsHistory
     */
    private $smsHistory;

    public function __construct(SmsHistory $smsHistory)
    {

        $this->smsHistory = $smsHistory;
    }


    public function del($id)
    {
        return $this->smsHistory->find($id)->smsHistoryRecipient()->get();
    }


    public function getDlr($id)
    {

    }

} 