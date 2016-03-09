<?php namespace App\Lib\Mailer;

use App\User;
use Illuminate\Support\Facades\Crypt;

class UserMailer extends Mailer {

    public function test()
    {
        $view = 'emails.welcome';
        $data = ['firstname'=>'Shegun', 'lastname'=>'Babs', 'username'=>'User'];
        $subject = "First Test email";
        $user = (Object) (['email'=>'shegun.babs@gmail.com']);

        return $this
            ->sendTo($user, $subject, $view, $data);
    }


    public function password_change(User $user)
    {
        $view= 'emails.user.password_change';
        $subject = 'Password change';
        $data = ['username'=>$user->username, 'date_and_time'=>$user->updated_at->toCookieString()];
        return $this->sendTo($user, $subject, $view, $data);
    }


    /**
     * Welcome Email for a new User.
     *
     * @param User $user
     */
    public function new_user_welcome_email(User $user)
    {
        $view = 'emails.user.new_user_register';
        $subject = 'Welcome to Mobilise Bulk SMS';
        $data = ['username' => $user->username, 'email'=> $user->email];
        return $this->sendTo($user, $subject, $view, $data);
    }

    public function welcome_social()
    {

    }

    public function welcome(){}


    /**
     * Send email to User to confirm account
     * @param User $user
     */
    public function confirm_account(User $user)
    {
        $view = 'emails.confirmation';
        $data = [
            'username' => $user->username,
            'confirm_url' => getenv('CONFIRM_URL') . $user->confirmation_code . '/' . Crypt::encrypt($user->id),
        ];
        $subject = 'Please confirm your email on '. getenv('SITE_NAME');

        return $this->sendTo($user, $subject, $view, $data);
    }

} 