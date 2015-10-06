<?php
namespace App\Lib\Auth;


use App\Lib\Services\Text\String;
use App\Repository\SmsCreditRepository;
use App\Repository\UserRepository;
use App\User;
use Illuminate\Contracts\Auth\Guard as Authenticator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Contracts\Factory as Socialite;


class AuthenticateUser {

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

    public function __construct(UserRepository $user, Socialite $socialite, Authenticator $auth, Request $request)
    {

        $this->user = $user;
        $this->socialite = $socialite;
        $this->auth = $auth;
        $this->request = $request;
    }


    public function execute($hasCode, $provider)
    {
        if ( ! $hasCode ) return $this->getAuthorizationFirst($provider);                   //1st time coming here. no ?$code but there is $provider

        if ( $hasCode && ! $provider ):                                                     //2nd time coming has $code but no provider
            $provider = $this->getProvider();
            $user = $this->socialite->driver($provider)->user();
            $isSocialUser = $this->user->getSocialUser($user->getEmail(), $provider);
            $getUserByEmail = $this->user->getUserByEmail($user->getEmail());
            //dd($isSocialUser[0]);
            if (is_null($user->getEmail())):
                flash()->overlay(self::NO_EMAIL);
                return redirect()->to('user/login');
            endif;

            switch ( true ) {
                case ( (bool) $isSocialUser->count() ):
                    //social user
                    $this->auth->login($isSocialUser[0]);
                    $this->removeProvider($provider);
                    flash()->overlay(self::LOGIN_SUCCESSFUL);
                    return redirect()->intended('user/dashboard');
                    break;
                case ( (bool) $getUserByEmail->count() ):
                    //user already exist
                    $this->removeProvider($provider);
                    flash()->overlay(self::USER_EXISTS);
                    return redirect()->to('user/login');
                    break;
                default:
                    //create social user
                    $user = $this->createUser($user, $provider);
                    $this->auth->login($user, true);
                    $this->removeProvider($provider);
                    flash()->overlay(self::LOGIN_SUCCESSFUL);
                    return redirect()->intended('user/dashboard');
                break;
            }
        endif;
    }


    private function getAuthorizationFirst($provider)
    {
        if ( in_array($provider, $this->providers) ):
            $this->saveProvider($provider);
            return $this->socialite->driver($provider)->redirect();
        endif;
        flash()->overlay(self::INVALID_PROVIDER);
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
        $username =  String::replaceChar($user->getName());
        $password = bcrypt( String::randomString() );
        $social_auth_type = $provider;
        $social_auth = 1;

        $user = User::create( compact('email', 'username', 'password', 'social_auth', 'social_auth_type') );
        SmsCreditRepository::createNewAccount($user);

        return $user;
    }

}