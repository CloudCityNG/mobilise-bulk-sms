<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;

class SessionsController extends Controller {


    function __construct()
    {
        $this->middleware('guest', ['only'=>['store','create']]);
    }


    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('user.login');
	}

    /**
     * Store a newly created resource in storage.
     *
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
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy()
	{
		Auth::logout();
        View::share('currentUser', null);
        flash()->overlay("You have been logged out successfully");
        return redirect()->route('login_path');
	}

}
