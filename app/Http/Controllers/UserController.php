<?php namespace App\Http\Controllers;

use App\Commands\ChangePasswordCommand;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller {


    public function __construct()
    {
        $this->middleware('auth');
    }


	public function dashboard()
    {
        return view('user.dashboard');
    }


    public function changePassword()
    {
        return view('user.change-password')
            ->with('page_title', 'Change Password')
            ;
    }


    public function postChangePassword(ChangePasswordRequest $request)
    {
        $email = Auth::user()->email;
        if ( Auth::validate(['email'=>$email,'password'=>$request->get('password')]) ) {
            $this->dispatchFrom(ChangePasswordCommand::class, $request, ['user_email'=>$email]);
            flash()->overlay('Password Change Successful');
            return redirect()->to('user/dashboard');
        }
        flash()->overlay('Password Change Unsuccessful','Wrong Password');
        return redirect()->back();
    }


    public function accountSetting()
    {
        return view('user.account-setting');
    }

}
