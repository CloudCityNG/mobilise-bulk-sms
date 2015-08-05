<?php namespace App\Commands;

use App\Commands\Command;

use App\Models\Contact;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class NewContactCommand extends Command implements SelfHandling {

    //use InteractsWithQueue, SerializesModels;
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
        $this->user = $user;
        $this->inputs = $this->trimArray($inputs);
    }

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle()
	{
        $this->inputs = array_map('trim', $this->inputs);
		$contact = Contact::store($this->inputs);
        $this->user->contacts()->save($contact);
        //@TODO event--newContactWasCreated.
	}


    public function trimArray($input)
    {
        $out = [];
        foreach ( $input as $key => $value )
        {
            if ( !isset($value) || !empty($value) ):
                $out[$key] = $value;
            endif;
        }
        return $out;
    }

}
