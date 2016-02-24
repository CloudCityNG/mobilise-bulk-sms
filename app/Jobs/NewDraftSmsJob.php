<?php

namespace App\Jobs;

use App\Jobs\Job;
use App\Repository\SmsDraftRepository;
use Illuminate\Contracts\Bus\SelfHandling;

class NewDraftSmsJob extends Job implements SelfHandling
{
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
    private $flash;
    /**
     * @var
     */
    private $schedule;

    /**
     * Create a new job instance.
     *
     * @param $sender
     * @param $recipients
     * @param $message
     * @param $flash
     * @param $schedule
     * @return \App\Jobs\NewDraftSmsJob
     */
    public function __construct($sender, $recipients, $message, $flash, $schedule)
    {
        $this->sender = $sender;
        $this->recipients = $recipients;
        $this->message = $message;
        $this->flash = $flash;
        $this->schedule = $schedule;
    }

    /**
     * Execute the job.
     *
     * @param SmsDraftRepository $repository
     * @return void
     */
    public function handle(SmsDraftRepository $repository)
    {
        $repository->save([
            'sender'=>$this->sender,
            'recipients'=>$this->recipients,
            'message'=>$this->message,
            'flash'=>$this->flash,
            'schedule'=>$this->schedule
        ]);
    }
}
