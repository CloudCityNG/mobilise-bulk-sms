<?php namespace App\Commands;

use App\Commands\Command;

use App\Models\Group;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldBeQueued;

class NewGroup extends Command implements SelfHandling, ShouldBeQueued {

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
     * @return \App\Commands\NewGroup
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
		$group = Group::store($this->inputs);
        $this->user->group()->save($group);
        //@TODO event->newGroupWasCreated
	}

}
