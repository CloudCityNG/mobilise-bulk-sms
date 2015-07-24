<?php namespace App\Commands;

use App\Commands\Command;

use App\Repository\UserRepository;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldBeQueued;

class ChangePasswordCommand extends Command implements SelfHandling, ShouldBeQueued {

	use InteractsWithQueue, SerializesModels;
    /**
     * @var
     */
    private $password;
    /**
     * @var
     */
    private $new_password;
    /**
     * @var
     */
    private $new_password_confirmation;
    /**
     * @var
     */
    private $user_email;

    /**
     * Create a new command instance.
     *
     * @param $user_email
     * @param $password
     * @param $new_password
     * @param $new_password_confirmation
     * @return \App\Commands\ChangePasswordCommand
     */
	public function __construct($user_email, $password, $new_password, $new_password_confirmation)
	{

        $this->password = $password;
        $this->new_password = $new_password;
        $this->new_password_confirmation = $new_password_confirmation;
        $this->user_email = $user_email;
    }

    /**
     * Execute the command.
     *
     * @param UserRepository $repository
     * @return void
     */
	public function handle(UserRepository $repository)
	{
        //dd($this->password);
        $r = $repository->changePassword($this->user_email, $this->password, $this->new_password);
        //if pass
        if ($r):
            //send user pass email
            //@TODO event--UserPasswordChangePass
        else:
        //if fail
            //send user fail email
            //@TODO event--UserPasswordChangeFailed
        endif;
	}

}
