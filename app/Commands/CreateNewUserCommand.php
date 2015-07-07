<?php namespace App\Commands;

use App\Commands\Command;

use App\Lib\Mailer\UserMailer;
use App\Repository\SmsCreditRepository;
use App\Repository\UserRepository;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Illuminate\Support\Facades\Auth;

class CreateNewUserCommand extends Command implements SelfHandling, ShouldBeQueued {

	use InteractsWithQueue, SerializesModels;

    /**
     * @var
     */
    private $username;
    /**
     * @var
     */
    private $email;
    /**
     * @var
     */
    private $password;


    /**
     * Create a new command instance.
     *
     * @param $username
     * @param $email
     * @param $password
     * @return \App\Commands\CreateNewUserCommand
     */
	public function __construct($username, $email, $password )
	{
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * Execute the command.
     *
     * @param UserRepository $userRepository
     * @param SmsCreditRepository $creditRepository
     * @return void
     */
	public function handle(UserRepository $userRepository, SmsCreditRepository $creditRepository, UserMailer $mailer)
	{
		//create user with account enabled.
        $user = $userRepository->save( $this->username, $this->email, $this->password );
        //create SMS account
        $creditRepository->createNewAccount($user);

        //log user in
        Auth::login($user);

        //event--newUserWasCreated
        //use queue for now. Send User welcome email
        $mailer->new_user_welcome_email(Auth::user());
	}

}
