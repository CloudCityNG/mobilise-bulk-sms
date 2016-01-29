<?php
namespace App\Jobs;

use App\Jobs\Command;

use App\Repository\SmsDraftRepository;
use Illuminate\Contracts\Bus\SelfHandling;

class NewDraftSmsCommand extends Command implements SelfHandling {
    /**
     * @var
     */
    private $sender;
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
     * @var
     */
    private $recipients;

    /**
     * Create a new command instance.
     *
     * @param $sender
     * @param $recipients
     * @param $message
     * @param $flash
     * @param $schedule
     * @return \App\Jobs\NewDraftSmsCommand
     */
	public function __construct($sender, $recipients, $message, $flash, $schedule)
	{
		//
        $this->sender = $sender;
        $this->message = $message;
        $this->flash = $flash;
        $this->schedule = $schedule;
        $this->recipients = $recipients;
    }

    /**
     * Execute the command.
     *
     * @param SmsDraftRepository $repository
     * @return void
     */
	public function handle(SmsDraftRepository $repository)
	{
		$repository->save( ['sender'=>$this->sender, 'recipients'=>$this->recipients, 'message'=>$this->message, 'flash'=>$this->flash, 'schedule'=>$this->schedule] );
	}

}
