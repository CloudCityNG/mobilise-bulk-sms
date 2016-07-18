<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BillingController extends Controller
{
    //

    /**
     * BillingController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth']);
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
}
