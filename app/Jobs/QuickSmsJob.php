<?php

namespace App\Jobs;

use App\Jobs\Job;
use App\Lib\Sms\SmsInfobip;
use App\Models\Sms\SmsHistory;
use App\Models\Sms\SmsHistoryRecipient;
use App\Repository\SmsCreditRepository;
use App\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class QuickSmsJob extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;
    /**
     * @var
     */
    private $sender;
    /**
     * @var
     */
    private $recipients;
    /**
     * @var
     */
    private $message;
    /**
     * @var
     */
    private $schedule;
    /**
     * @var
     */
    private $flash;
    /**
     * @var
     */
    private $user_id;

    /**
     * Create a new job instance.
     *
     * @param $sender
     * @param $recipients
     * @param $message
     * @param $schedule
     * @param $flash
     * @param $user_id
     * @return \App\Jobs\QuickSmsJob
     */
    public function __construct($sender, $recipients, $message, $schedule, $flash, $user_id)
    {
        //
        $this->sender = $sender;
        $this->recipients = $recipients;
        $this->message = $message;
        $this->schedule = $schedule;
        $this->flash = $flash;
        $this->user_id = $user_id;
    }

    /**
     * Execute the job.
     *
     * @param SmsCreditRepository $smsCreditRepository
     * @param SmsInfobip $infobip
     * @param SmsHistory $history
     * @param SmsHistoryRecipient $historyRecipient
     * @return void
     */
    public function handle(SmsCreditRepository $smsCreditRepository, SmsInfobip $infobip, SmsHistory $history, SmsHistoryRecipient $historyRecipient)
    {
        //calculate total bill for user
        $total_units = $smsCreditRepository->getSmsBill($this->recipients, $this->message);

        //deduct bill from user account
        $smsCreditRepository->billUser($total_units, $this->user_id);

        //now send sms
        $s = $infobip->setSender($this->sender)
            ->setRecipients($this->recipients)
            ->setMessage($this->message)
            ->setSchedule($this->schedule)
            ->flash($this->flash)
            ->send();

        //save the SMS
        $user = User::find($this->user_id);
        $sms_history = $history->store($this->sender, $this->message, $this->schedule, $total_units, $this->flash);
        $sms_history_row = $user->smshistory()->save( $sms_history );

        //process the response and save to DB
        $s = json_decode($s, true);
        $recipients = [];

        //update the recipient table with the recipients
        foreach ( $s['results'] as $result )
        {
            $recipients[] = $historyRecipient->store($result['status'], $result['messageid'], $result['destination']);
        }

        $s = $history->find($sms_history_row->id);
        $s->smsHistoryRecipient()->saveMany($recipients);
    }
}
