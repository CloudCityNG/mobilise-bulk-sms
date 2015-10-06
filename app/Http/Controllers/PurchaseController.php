<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Lib\Payments\PayPal\CheckOut;
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
        $q = DB::select('select unit_price from pricing where ? >= lower_range and ? <= upper_range', [$quantity,$quantity]);
        $unit_price = $q[0]->unit_price;

        $payment_info = [
            'invoiceNumber' => 60067,
            'product'       => $quantity.' units of Bulk SMS.',
            'quantity'      => 1,
            'shipping'      => ($quantity*$unit_price)*0.15,
            'price'         => $quantity*$unit_price,
        ];
        $payment_info['total'] = (float)$payment_info['price'] + (float)$payment_info['shipping'];
        //set session here
        if( $request->session()->has('payment_info') )
            $request->session()->forget('payment_info');
            $request->session()->put('payment_info', $payment_info);

        return view('user.confirm-credit-purchase', ['sms_quantity'=>$quantity,'unit_price'=>$unit_price,'total_cost'=> $quantity*$unit_price]);
    }


    public function start(Request $request, CheckOut $checkOut)
    {
//        if ( $request->header('referer') != 'http://lara.app/user/credit-purchase' )
//            return redirect()->back();

        if ( ! $request->session()->has('payment_info') )
            return redirect()->back();

        //dd(create_object($request->session()->get('payment_info')));
        $payment_info = create_object($request->session()->get('payment_info'));

        return $checkOut->process( $payment_info );

    }

}
