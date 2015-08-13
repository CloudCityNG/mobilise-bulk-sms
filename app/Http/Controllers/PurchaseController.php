<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Pricing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller {


    public function creditPurchase()
    {
        return view('user.credit-purchase',['data'=> Pricing::getAllRows()]);
    }


    public function postCreditPurchase(Request $request)
    {
        $this->validate($request, ['sms_quantity'=>'required|numeric|min:100|max:5000000']);
        $quantity = (int) $request->get('sms_quantity');
        //$q = Pricing::whereRaw('? >= lower_range and ? <= upper_range', [$quantity,$quantity])->get();
        //$q = Pricing::whereRaw('lower_range <= ? and upper_range >= ?', [$quantity,$quantity])->get()->toArray();
        $q = DB::select('select unit_price from pricing where ? >= lower_range and ? <= upper_range', [$quantity,$quantity]);
        $unit_price = $q[0]->unit_price;
        return view('user.confirm-credit-purchase', ['sms_quantity'=>$quantity,'unit_price'=>$unit_price,'total_cost'=> $quantity*$unit_price]);
    }

}
