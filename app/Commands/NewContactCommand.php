<?php namespace App\Commands;

use App\Commands\Command;

use App\Models\Contact;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class NewContactCommand extends Command implements SelfHandling, ShouldBeQueued {

    use InteractsWithQueue, SerializesModels;
    /**
     * @var array
     */
    private $inputs;
    /**
     * @var
     */
    private $user;

    /**
     * Create a new command instance.
     *
     * @param array $inputs
     * @param $user
     * @return \App\Commands\NewContactCommand
     */
	public function __construct(Array $inputs, $user)
	{

        $this->inputs = $inputs;
        $this->user = $user;
    }

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle()
	{
		$contact = Contact::store($this->inputs);
        $this->user->smscontact()->save($contact);
        //@TODO event--newContactWasCreated.
	}

}
