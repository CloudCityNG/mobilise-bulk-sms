<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserDetailRequest;
use App\Models\Order;
use App\Models\Transaction;
use App\Repository\TransactionRepository;
use App\Repository\UserDetailRepository;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class SettingsController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }


    public function account()
    {
        return view('kanda.settings.profile', ['userSidebar'=>true]);
    }


    public function postAccount(Request $request)
    {
        $all = $request->all();

        $validator = Validator::make($all, [
            'username'              => 'required|min:6|alpha_dash|unique:users,username,'.Auth::user()->id,
            'password'              => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
        ]);

        $validator->after(function($validator) use($all){
            if ( ! Hash::check($all['old_password'], Auth::user()->password) )
            {
                $validator->errors()->add('old_password', 'Your Old password is incorrect');
            }
        });

        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator);
        }else {
            //update user account
            Auth::user()->fill([
                'username'  => $all['username'],
                'password'  => Hash::make($all['password']),
            ])->save();
        }

        Auth::logout();
        View::share('currentUser', null);

        flash()->success('Your profile has been updated. Please login again');
        return redirect()->to('user/login');
    }


    public function other_details()
    {
        return 'active';
    }


    public function notifications()
    {
        return 'active';
    }


    public function orders()
    {
        $data = Auth::user()->order()->paginate(5);
        return view('kanda.settings.orders', ['userSidebar'=>true, 'data'=>$data]);
    }


    public function payments()
    {
        $data = DB::table('transactions')
            ->join('orders', 'transactions.transaction_code', '=', 'orders.transaction_code')
            ->where('transactions.status', '=', 'approved')
            ->where('transactions.user_id', '=', Auth::user()->id)
            ->select('transactions.*', 'orders.price', 'orders.item')
            ->paginate(5);
        //dd($data);

        return view('kanda.settings.payment', ['userSidebar'=>true, 'data'=>$data]);
    }


    public function transactions()
    {
        return 'active';
    }


    public function profile()
    {
        return view('settings.profile', ['userSidebar'=>true]);
    }


    public function postProfile(UserDetailRequest $request, UserDetailRepository $repository)
    {
        $inputs = array_map('set_null', $request->only('firstname', 'lastname', 'phone', 'address', 'dob'));
        $repository->save( $inputs );
        flash()->overlay('Profile Updated Successfully');
        return redirect()->back();
    }


    public function security()
    {
        return view('settings.security', ['userSidebar'=>true]);
    }





}
