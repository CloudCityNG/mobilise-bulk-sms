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
        $this->validate($request,[
            'username'              => 'required|min:6|alpha_dash|unique:users,username',
            'password'              => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
        ]);

        flash()->success('Your profile has been updated.');
        return redirect()->back();
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
