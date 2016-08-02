<?php
namespace App\Http\Controllers;

use App\Http\Requests\UserDetailRequest;
use App\Jobs\ChangePasswordCommand;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\ChangePasswordRequest;
use App\Repository\UserDetailRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }


    public function dashboard()
    {
        $sent_sms = Auth::user()->smshistory()->count();
        $undelivered_messages = number_to_word(Auth::user()->smshistoryrecipient()->where('status', '!=', 'SENT')->count());
        $contacts = 0;
        $credit_purchased = 0;
        $credits = 0;
        $saved_messages = 0;

        return view('kanda.user.dashboard', compact(
            "sent_sms",
            "undelivered_messages",
            "contacts",
            "credit_purchased",
            "credits",
            "saved_messages"
        ));
    }


    public function changePassword()
    {
        $out = ['page_title' => 'Change Password', 'userSidebar' => true];
        return view('user.change-password', $out);
    }


    public function postChangePassword(ChangePasswordRequest $request)
    {
        $email = Auth::user()->email;
        if (Auth::validate(['email' => $email, 'password' => $request->get('password')])) {
            $this->dispatchFrom(ChangePasswordCommand::class, $request, ['user_email' => $email]);
            flash()->overlay('Password Change Successful');
            return redirect()->to('user/dashboard');
        }
        flash()->overlay('Password Change Unsuccessful', 'Wrong Password');
        return redirect()->back();
    }


    public function accountSetting()
    {
        return view('user.account-setting');
    }


    public function profile()
    {
        //rodd(Auth::user()->userdetails()->count());
        return view('bootswatch.user.profile');
    }


    public function profileGet(UserDetailRequest $request)
    {
        if ($request->ajax()) {
            $out = ['firstname' => 'segun', 'lastname' => 'babs'];
            return response()->json(['success' => true, 'out' => $out]);
        }
    }


    public function profileEdit(UserDetailRequest $request, UserDetailRepository $userDetailRepository)
    {
        if ($request->ajax()):
            $inputs = $request->only('firstname', 'lastname', 'phone', 'dob');
            $userDetailRepository->save($inputs);
            $out = view('ajax.userdetails')->render();
            return response()->json(['success' => true, 'out' => $out]);
        endif;
        //validate
        //save to db
        //fetch back
        //render view
        //return rendered view back to server
    }


    public function settings()
    {
        return view('bootswatch.user.settings');
    }


    public function support()
    {
        return view('bootswatch.user.support');
    }


    public function faqs()
    {
        return view('bootswatch.user.faqs');
    }
}
