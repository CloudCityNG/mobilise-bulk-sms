<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Lib\Payments\PayPal\CheckOut;
use App\Models\Pricing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller {


    function __construct()
    {
        $this->middleware('auth');
    }
    

    public function creditPurchase()
    {
        return view('kanda.user.credit-purchase',['data'=> Pricing::getAllRows()]);
        return view('user.credit-purchase',['data'=> Pricing::getAllRows()]);
    }

    public function postCreditPurchase(Request $request)
    {
        $this->validate($request, ['sms_quantity'=>'required|numeric|min:100|max:5000000']);

        $quantity = (int) $request->get('sms_quantity');
        $q = DB::select('select unit_price from pricing where ? >= lower_range and ? <= upper_range', [$quantity,$quantity]);
        $unit_price = $q[0]->unit_price;
        $txid_order = 'QUICSMS01'.rand(10000, 99999);
        $price = $quantity*$unit_price;

        $transaction_info = [
            'checkout_url'   => 'https://oameye.works.payments.payquic.com/checkout/',
            'return_uri'    => 'http://lara.app/user/payment-return',
            'trxid'         => 'QUICSMS01',
            'price'         => '',
            'logo_url'      => 'https://s3.eu-central-1.amazonaws.com/storage-001/public/quicsmsnew.gif',
            'cmd'           => 'checkout',
            'title_name'    => 'QUIC SMS Credit Purchase',
            'bk_color'      => '',
            'rg_color'      => '',
            'merchant_id'   => 'PAYQUICSMS09',
            'merchant_key'  => 'PAY001D1',
            'poid'          => 'QUICSMS01',
            'txid'          => $txid_order,
            'item'          => 'QuicSMS Credit Purchase - ₦' . $price ,
            'price'         => $price * 100,
            'currency'      => 'NG',
            'shipping'      => 0,
            'country'       => 'NG',
            'return_script' => ''

        ];

        return view('kanda.user.confirm_credit-purchase', [
            'sms_quantity'      => $quantity,
            'unit_price'        => $unit_price,
            'total_cost'        => $quantity*$unit_price,
            'transaction_info'  => create_object($transaction_info),
        ]);


    }


    public function paymentReturn(Request $request)
    {
        dd($request->all());
    }


//    public function postCreditPurchaseBackup(Request $request)
//    {
//        $this->validate($request, ['sms_quantity'=>'required|numeric|min:100|max:5000000']);
//        $quantity = (int) $request->get('sms_quantity');
//        $q = DB::select('select unit_price from pricing where ? >= lower_range and ? <= upper_range', [$quantity,$quantity]);
//        $unit_price = $q[0]->unit_price;
//
//        $payment_info = [
//            'invoiceNumber' => 60067,
//            'product'       => $quantity.' units of Bulk SMS.',
//            'quantity'      => 1,
//            'shipping'      => ($quantity*$unit_price)*0.15,
//            'price'         => $quantity*$unit_price,
//        ];
//        $payment_info['total'] = (float)$payment_info['price'] + (float)$payment_info['shipping'];
//        //set session here
//        if( $request->session()->has('payment_info') )
//            $request->session()->forget('payment_info');
//            $request->session()->put('payment_info', $payment_info);
//
//        //return view('kanda.user.confirm-credit-purchase', ['sms_quantity'=>$quantity,'unit_price'=>$unit_price,'total_cost'=> $quantity*$unit_price]);
//        return view('user.confirm-credit-purchase', ['sms_quantity'=>$quantity,'unit_price'=>$unit_price,'total_cost'=> $quantity*$unit_price]);
//    }


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
