<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\LoginRequest;
use App\Lib\Auth\AuthenticateUser;
use App\Repository\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Laravel\Socialite\Facades\Socialite;

class SessionsController extends Controller {


    const ERROR_MSG1 = "";
    const ERROR_MSG2 = "";
    const ERROR_MSG3 = "";


    function __construct()
    {
        $this->middleware('guest', ['only'=>['store','create']]);
    }


	/**
	 * Return Login page
	 * @return Response
	 */
	public function create()
	{
		return view('user.login');
	}


    public function socialLogin(AuthenticateUser $authenticateUser, Request $request, $provider=null)
    {
        return $authenticateUser->execute($request->has('code'), $provider);
    }


    public function handleProviderCallback(Request $request, UserRepository $repository)
    {
        $provider = session('provider');
        //error strings
        $error = $request->get('error');
        $error_code = $request->get('error_code');
        $error_message = $request->get('error_message');
        $error_description = $request->get('error_description');
        $error_reason = $request->get('error_reason');

        //if general error occur
        if ( null !== $error_code && null !== $error_message ) {
            flash()->overlay($error_message, $error_code);
            return redirect()->to('user/login');
        }

        //if user cancels the auth
        if ( null !== $error && null !== $error_code && null !== $error_description && null !== $error_reason ) {
            flash()->overlay($error_description, $error);
            return redirect()->to('user/login');
        }

        $user = Socialite::with($provider)->user();

        if ( $user->email === null ){
            flash()->overlay('Please provide information about your email before you can login');
            return redirect()->to('user/login');
        }


        $db_user_s = $repository->getSocialUser($user->email, $provider);
        $db_user = $repository->getUserByEmail($user->email);

        //check if user exists
        switch (true)
        {
            case ( (bool)$db_user_s->count() ):
                //log user in
                flash()->overlay('We are supposed to log user in');
                return redirect()->to('user/login');
            break;

            case ( (bool)$db_user->count() ):
                flash()->overlay("The email associated with the $provider account is already registered.");
                return redirect()->to('user/login');
            break;
            default:
        }

        dd($user);
    }


    /**
     * Log User In.
     * @param LoginRequest $request
     * @return Response
     */
	public function store(LoginRequest $request)
	{
        $login_data = $request->only('email', 'password');
        $rememberMe = $request->get('rememberMe');

        if ( Auth::attempt($login_data, $rememberMe) ) {
            flash()->overlay("You have been successfully logged in", "Welcome");
            return redirect()->intended('user/dashboard');
        }

        //flash()->overlay('Email/Password invalid', "Login Error");
        flash()->error('Email/Password invalid');
        return redirect()->back()->withInput(Input::except('password'))
            //->withErrors(['email'=>'Email and/or password invalid'])
            ;
	}


	/**
     * Log user out
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy()
	{
		Auth::logout();
        View::share('currentUser', null);
        flash()->overlay("You have been logged out successfully");
        return redirect()->to('/user/login');
	}

}
