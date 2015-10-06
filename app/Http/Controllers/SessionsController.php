<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\LoginRequest;
use App\Lib\Auth\AuthenticateUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;


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

        flash()->error('Email/Password invalid');
        return redirect()->back()->withInput(Input::except('password'));
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
