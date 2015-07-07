<?php namespace App\Commands;

use App\Commands\Command;

use App\Lib\Sms\SmsInfobip;
use App\Models\Sms\SmsHistory;
use App\Models\Sms\SmsHistoryRecipient;
use App\Repository\SmsCreditRepository;
use App\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldBeQueued;

class QuickSms extends Command implements SelfHandling, ShouldBeQueued {

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
     * @var User
     */
    private $user;

    /**
     * Create a new command instance.
     *
     * @param User $user
     * @param $sender
     * @param $recipients
     * @param $message
     * @param $schedule
     * @param $flash
     * @return \App\Commands\QuickSms
     */
	public function __construct(User $user, $sender, $recipients, $message, $schedule, $flash)
	{
		//
        $this->sender = $sender;
        $this->recipients = $recipients;
        $this->message = $message;
        $this->schedule = $schedule;
        $this->flash = $flash;
        $this->user = $user;

        if (!$this->flash)
            $this->flash = 0;
    }

    /**
     * Execute the command.
     *
     * @param SmsCreditRepository $repository
     * @param SmsInfobip $infobip
     * @param SmsHistory $history
     * @param SmsHistoryRecipient $historyRecipient
     * @return void
     */
	public function handle(SmsCreditRepository $repository, SmsInfobip $infobip, SmsHistory $history, SmsHistoryRecipient $historyRecipient)
	{
		//calculate bill
        $total_units = $repository->getSmsBill($this->recipients, $this->message);
        //deduct bill from user account
        $repository->billUser($total_units);
        //send SMS
        $s = $infobip->setSender($this->sender)
                    ->setRecipients($this->recipients)
                    ->setMessage($this->message)
                    ->flash($this->flash)
                    ->setSchedule($this->schedule)
                    ->send();
        //save the SMS
        $sms_history = $history->store($this->sender, $this->message, $this->schedule, $total_units, $this->flash);
        $sms_history_row = $this->user->smshistory()->save( $sms_history );

        //process the response and save to DB
        $s = json_decode($s, true);
        $recipients = [];

        //update the recipient table with
        foreach ($s['results'] as $result){
            $recipients[] = $historyRecipient->store($result['status'], $result['messageid'], $result['destination']);
        }

        $s = $history->find($sms_history_row->id);
        $s->smsHistoryRecipient()->saveMany($recipients);

	}

}
