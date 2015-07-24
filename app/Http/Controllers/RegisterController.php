<?php namespace App\Http\Controllers;

use App\Commands\CreateNewUserCommand;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\NewUserRegistrationRequest;
use Illuminate\Http\Request;

class RegisterController extends Controller {


    function __construct()
    {
        $this->middleware('guest');
    }


    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('user.register');
	}

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
	public function store(NewUserRegistrationRequest $request)
	{
        //validate
        $d = $request->only('username', 'email', 'password');
        $this->dispatch( new CreateNewUserCommand($d['username'], $d['email'], $d['password']) );

        flash()->overlay('User Account created.', 'New User Registration');
        return redirect()->to('user/dashboard');
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
	public function destroy($id)
	{
		//
	}

}
