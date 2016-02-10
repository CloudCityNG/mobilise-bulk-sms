<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Jobs\CreditAccountJob;
use App\Lib\Payments\InterSwitch\CheckOut;
use App\Lib\Payments\PayPal\CheckOut as PayPalCheckOut;
use App\Models\Pricing;
use App\Repository\OrderRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{


    function __construct()
    {
        $this->middleware('auth');
    }


    public function creditPurchase(OrderRepository $repository)
    {
        return view('kanda.user.credit-purchase', ['data' => Pricing::getAllRows()]);
        //return view('user.credit-purchase',['data'=> Pricing::getAllRows()]);
    }

    public function postCreditPurchase(Request $request, OrderRepository $orderRepository)
    {
        //get the price and display porchase/order info
        $this->validate($request, ['sms_quantity' => 'required|numeric|min:100|max:5000000']);

        $quantity = (int)$request->get('sms_quantity');
        $q = DB::select('select unit_price from pricing where ? >= lower_range and ? <= upper_range', [$quantity, $quantity]);
        $unit_price = $q[0]->unit_price;

        $price = $orderRepository->getPrice($quantity, $unit_price);

        $order_info = [
            'title_name' => 'QUIC SMS Credit Purchase',
            'poid' => 'QUICSMS01',
            'order_number' => $orderRepository->genOrderNumber(),
            'quantity' => $quantity,
            'unit_price' => $unit_price,
            'price' => $orderRepository->priceToKobo($price),
            'item' => $quantity . ' QuicSMS Credit Purchase - N' . $price,
            'txid' => $orderRepository->getTransactionID(),
        ];

        //$orderRepository->save($transaction_info);

        return view('kanda.user.confirm_credit-purchase', [
            'sms_quantity' => $quantity,
            'unit_price' => $unit_price,
            'total_cost' => $price,
            'transaction_info' => create_object($order_info),
        ]);


    }


    public function approve(Request $request, OrderRepository $repository, $order_id, $txid, $poid, $quantity, $unit_price, $price, $item)
    {
        //save incoming request & redirect to payment portal
        $checkout_url = env('CHECKOUT_URL');
        $order = [
            'return_script' => env('RETURN_SCRIPT'),
            'country' => env('COUNTRY'),
            'shipping' => (int)env('SHIPPING'),
            'currency' => env('CURRENCY'),
            'price' => $price,
            'item' => $item,
            'txid' => $txid,
            'poid' => $poid,
            'return_uri' => env('RETURN_URI'),
            'merchant_key' => env('MERCHANT_KEY'),
            'merchant_id' => env('MERCHANT_ID'),
            'rg_color' => env('RG_COLOR'),
            'bk_color' => env('BK_COLOR'),
            'title_name' => 'QUIC SMS CREDIT PURCHASE',
            'logo_url' => env('LOGO_URL'),
            'cmd' => env('CMD'),
            'order_number' => $order_id,
            'quantity' => $quantity,
            'unit_price' => $unit_price,
            'price' => $price,
        ];
        $repository->save($order);

        $post_data = http_build_query($order);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $checkout_url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_POST, count($post_data));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $order);
        $output = curl_exec($ch);

        if ($output === false) {
            echo "Error Number:" . curl_errno($ch) . "<br>";
            echo "Error String:" . curl_error($ch);
        }

        curl_close($ch);

        return;
    }


    public function paymentReturn(Request $request, CheckOut $checkOut)
    {
        $r = $request->all();
        //return $checkOut->processReturn($r);
        $checkOut->processReturn($r, $request->user()->id);

        //do customer credit job here
        $this->dispatchFromArray('App\Jobs\CreditAccountJob', [
            'transaction_code' => $r['transaction_code'],
            'transaction_ref' => $r['transaction_ref'],
            'user' => $request->user(),
        ]);
        //$this->dispatchFrom(CreditAccountJob::class, $request, ['user'=>$request->user()]);
        return redirect()->to('user/credit-purchase');

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


    public function start(Request $request, PayPalCheckOut $checkOut)
    {
//        if ( $request->header('referer') != 'http://lara.app/user/credit-purchase' )
//            return redirect()->back();

        if (!$request->session()->has('payment_info'))
            return redirect()->back();

        //dd(create_object($request->session()->get('payment_info')));
        $payment_info = create_object($request->session()->get('payment_info'));

        return $checkOut->process($payment_info);

    }

}
