<?php
namespace App\Lib\Auth;


use App\Lib\Mailer\UserMailer;
use App\Lib\Services\Text\String_;
use App\Repository\SmsCreditRepository;
use App\Repository\UserRepository;
use App\User;
use Illuminate\Contracts\Auth\Guard as Authenticator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Contracts\Factory as Socialite;


class AuthenticateUser
{

    const INVALID_PROVIDER = "You provided an invalid social provider. Please try again";
    const LOGIN_SUCCESSFUL = "You have been logged in successfully";
    const USER_EXISTS = "This email is already registered with us. Please login with your email.";
    const NO_EMAIL = "Please authorize your email for successful login.";

    /**
     * @var UserRepository
     */
    private $user;
    /**
     * @var Socialite
     */
    private $socialite;
    /**
     * @var Authenticatable
     */
    private $auth;
    private $providers = ['facebook', 'google', 'github'];
    /**
     * @var Request
     */
    private $request;
    /**
     * @var UserMailer
     */
    private $mailer;

    public function __construct(UserRepository $user, Socialite $socialite, Authenticator $auth, Request $request, UserMailer $mailer)
    {

        $this->user = $user;
        $this->socialite = $socialite;
        $this->auth = $auth;
        $this->request = $request;
        $this->mailer = $mailer;
    }


    public function execute($hasCode, $provider)
    {
        if ($this->request->has('error_code') && $this->request->has('error_message')):
            flash()->error($this->request->get('error_message'));
            return redirect()->back();
        endif;

        if (!$hasCode) return $this->getAuthorizationFirst($provider);                   //1st time coming here. no ?$code but there is $provider

        if ($hasCode && !$provider):                                                     //2nd time coming has $code but no provider
            $provider = $this->getProvider();
            $user = $this->socialite->driver($provider)->user();
            $isSocialUser = $this->user->getSocialUser($user->getEmail(), $provider);
            $getUserByEmail = $this->user->getUserByEmail($user->getEmail());
            //dd($isSocialUser[0]);
            if (is_null($user->getEmail())):
                flash()->info(self::NO_EMAIL);
                return redirect()->to('user/login');
            endif;

            switch (true) {
                case ((bool)$isSocialUser->count()):
                    //social user
                    $this->auth->login($isSocialUser[0]);
                    $this->removeProvider($provider);
                    flash()->success(self::LOGIN_SUCCESSFUL);
                    return redirect()->intended('user/dashboard');
                    break;
                case ((bool)$getUserByEmail->count()):
                    //user already exist
                    $this->removeProvider($provider);
                    flash()->info(self::USER_EXISTS);
                    return redirect()->to('user/login');
                    break;
                default:
                    //create social user
                    $user = $this->createUser($user, $provider);
                    //welcome email
                    $this->mailer->new_user_welcome_email($user);
                    //log user in
                    $this->auth->login($user, true);
                    $this->removeProvider($provider);
                    flash()->success(self::LOGIN_SUCCESSFUL);
                    return redirect()->intended('user/dashboard');
                    break;
            }
        endif;
    }


    private function getAuthorizationFirst($provider)
    {
        if (in_array($provider, $this->providers)):
            $this->saveProvider($provider);
            return $this->socialite->driver($provider)->redirect();
        endif;

        flash()->error(self::INVALID_PROVIDER);
        return Redirect::to('user/login');
    }


    private function getProvider()
    {
        return $value = $this->request->session()->get('provider');
    }


    private function saveProvider($provider)
    {
        return $this->request->session()->put('provider', $provider);
    }


    private function removeProvider($provider)
    {
        $this->request->session()->forget('provider');
    }


    private function createUser($user, $provider)
    {
        $email = $user->getEmail();
        //for google business accounts, names are not present.
        //so check name first
        if (!empty($user->getName())) :
            $username = String_::replaceChar($user->getName());
        else:
            $username = explode("@", $user->getEmail())[0];
        endif;

        $password = bcrypt(String_::randomString());
        $social_auth_type = $provider;
        $social_auth = 1;

        $user = User::create(compact('email', 'username', 'password', 'social_auth', 'social_auth_type'));
        SmsCreditRepository::createNewAccount($user);

        return $user;
    }

}