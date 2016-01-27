<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Lib\Payments\PayPal\CheckOut;
use App\Models\Pricing;
use App\Repository\OrderRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller {


    function __construct()
    {
        $this->middleware('auth');
    }
    

    public function creditPurchase(OrderRepository $repository)
    {
        return view('kanda.user.credit-purchase',['data'=> Pricing::getAllRows()]);
        return view('user.credit-purchase',['data'=> Pricing::getAllRows()]);
    }

    public function postCreditPurchase(Request $request, OrderRepository $orderRepository)
    {
        $this->validate($request, ['sms_quantity'=>'required|numeric|min:100|max:5000000']);

        $quantity = (int) $request->get('sms_quantity');
        $q = DB::select('select unit_price from pricing where ? >= lower_range and ? <= upper_range', [$quantity,$quantity]);
        $unit_price = $q[0]->unit_price;

        $price = $orderRepository->getPrice($quantity, $unit_price);

        $transaction_info = [
            'checkout_url'   => env('CHECKOUT_URL'),
            'return_uri'    => env('RETURN_URI'),
            'trxid'         => 'QUICSMS01',
            'price'         => '',
            'logo_url'      => env('LOGO_URL'),
            'cmd'           => 'checkout',
            'title_name'    => 'QUIC SMS Credit Purchase',
            'bk_color'      => '#3B4752',
            'rg_color'      => '#E2DEEF',
            'merchant_id'   => 'PAYQUICSMS09',
            'merchant_key'  => 'PAY001D1',
            'poid'          => 'QUICSMS01',
            'txid'          => $orderRepository->getTransactionID(),
            'item'          => $quantity .' QuicSMS Credit Purchase - ₦' . $price ,
            'price'         => $orderRepository->priceToKobo($price),
            'currency'      => 'NG',
            'shipping'      => 0,
            'country'       => 'NG',
            'return_script' => env('RETURN_SCRIPT'),

            'order_number'  => $orderRepository->genOrderNumber(),
            'quantity'      => $quantity,
            'unit_price'    => $unit_price,

        ];

        $orderRepository->save($transaction_info);

        return view('kanda.user.confirm_credit-purchase', [
            'sms_quantity'      => $quantity,
            'unit_price'        => $unit_price,
            'total_cost'        => $price,
            'transaction_info'  => create_object($transaction_info),
        ]);


    }


    public function paymentReturn(Request $request, OrderRepository $repository)
    {
        if ( $request->get('action') == 'decline' && $repository->checkOrder($request->get('order')) !== NULL )
        {
            return 'declined & has order -  User declined from credit purchase page';
        }

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
