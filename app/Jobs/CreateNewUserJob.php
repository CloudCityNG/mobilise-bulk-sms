<?php

namespace App\Jobs;

use App\Jobs\Job;
use App\Lib\Mailer\UserMailer;
use App\Repository\SmsCreditRepository;
use App\Repository\UserRepository;
use Illuminate\Contracts\Bus\SelfHandling;

class CreateNewUserJob extends Job implements SelfHandling
{
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
     * Create a new job instance.
     *
     * @param $username
     * @param $email
     * @param $password
     * @return \App\Jobs\CreateNewUserJob
     */
    public function __construct($username, $email, $password)
    {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * Execute the job.
     *
     * @param UserRepository $userRepository
     * @param SmsCreditRepository $creditRepository
     * @param UserMailer $mailer
     * @return void
     */
    public function handle(UserRepository $userRepository, SmsCreditRepository $creditRepository, UserMailer $mailer)
    {
        //create user with account enabled
        $user = $userRepository->save($this->username, $this->email, $this->password);
        //create SMS account
        $creditRepository->createNewAccount($user);
        //log user In.
        Auth::login($user);
        //send user welcome message
        $mailer->new_user_welcome_email(Auth::user());
    }
}
