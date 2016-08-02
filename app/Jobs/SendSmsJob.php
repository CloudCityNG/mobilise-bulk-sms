<?php

namespace App\Jobs;

use App\Http\Billing\SmsBilling;
use App\Jobs\Job;
use App\Lib\Sms\PenSmsApi;
use App\Lib\Sms\SmsInfobip;
use App\Lib\Sms\SmsResponseHandler;
use App\Models\Sms\SmsHistory;
use App\Models\Sms\SmsHistoryRecipient;
use App\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;

class SendSmsJob extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;
    private $sender;
    private $recipients;
    private $message;
    private $schedule;
    private $flash;
    private $user_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Array $inputs)
    {
        $this->sender = $inputs['sender'];
        $this->recipients = $inputs['recipients'];
        $this->message = $inputs['message'];
        $this->schedule = $inputs['schedule'];
        $this->flash = $inputs['flash'];
        $this->user_id = $inputs['user_id'];
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(SmsInfobip $api, SmsBilling $billing, SmsHistory $history, SmsHistoryRecipient $historyRecipient)
    {
        DB::transaction(function () use ($billing, $history, $historyRecipient, $api) {

            //recheck user credit here.
            //calculate Bill & Bill
            $total_units = $billing->getSmsUnitBill($this->recipients, $this->message);
            $billing->billUserUnits($total_units, $this->user_id);
            $billing->logBillUnits($total_units, $this->user_id);


            //send SMS
            $s = $api->setSender($this->sender)
                ->setRecipients($this->recipients)
                ->setMessage($this->message)
                ->setSchedule($this->schedule)
                ->flash($this->flash)
                ->send();
            //$result = '{"results": [ {"status":"-22","messageid":"","destination":"000000000000"}, {"status":"0","messageid":"155060816184838810","destination":"2348099450165"} ]}';

            //save the SMS
            $user = User::find($this->user_id);
            $sms_history = $history->store($this->sender, $this->message, $this->schedule, $total_units, $this->flash);
            $sms_history_row = $user->smshistory()->save($sms_history);

            //process the response and save to DB
            $s = json_decode($s, true);
            $recipients = [];

            //update the recipient table with the recipients
            foreach ($s['results'] as $result) {
                    $recipients[] = $historyRecipient->store($result['status'], $result['messageid'], $result['destination']);
            }

            $s = $history->find($sms_history_row->id);
            $s->smsHistoryRecipient()->saveMany($recipients);
        });
    }
}
