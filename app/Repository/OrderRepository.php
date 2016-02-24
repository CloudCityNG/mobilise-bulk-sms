<?php
/**
 * Created by PhpStorm.
 * User: segun
 * Date: 1/26/2016
 * Time: 4:08 PM
 */

namespace App\Repository;


use App\Models\Order;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderRepository {


    function __construct()
    {
    }


    public function checkOrder($order_id)
    {
        return Auth::user()->order()->where('order_id', $order_id)->first();
    }


    public function getOrderInfo($order_id)
    {

        $transaction_info = [
//            'checkout_url'   => env('CHECKOUT_URL'),
//            'return_uri'    => env('RETURN_URI'),
//            'trxid'         => 'QUICSMS01',
//            'logo_url'      => env('LOGO_URL'),
//            'cmd'           => 'checkout',
//            'title_name'    => 'QUIC SMS Credit Purchase',
//            'bk_color'      => '#3B4752',
//            'rg_color'      => '#E2DEEF',
//            'merchant_id'   => 'PAYQUICSMS09',
//            'merchant_key'  => 'PAY001D1',
//            'poid'          => 'QUICSMS01',
//            'txid'          => $orderRepository->getTransactionID(),
//            'item'          => $quantity .' QuicSMS Credit Purchase - ₦' . $price ,
//            'price'         => $orderRepository->priceToKobo($price),
//            'currency'      => 'NG',
//            'shipping'      => 0,
//            'country'       => 'NG',
//            'return_script' => env('RETURN_SCRIPT'),
//
//            'order_number'  => $orderRepository->genOrderNumber(),
//            'quantity'      => $quantity,
//            'unit_price'    => $unit_price,
        ];
    }


    public function save(Array $transaction_info)
    {
    	//check if order already exists via its txid.
    	if ( $this->orderExists($transaction_info['txid']) ):
    		return;
    	else:
	    	$order = new Order();
	    	$order->product_id = $transaction_info['poid'];
	    	$order->order_id = $transaction_info['order_number'];
	    	$order->quantity = $transaction_info['quantity'];
	    	$order->unit_price = $transaction_info['unit_price'];
	    	$order->price = $transaction_info['price'];
	    	$order->item = $transaction_info['item'];
	    	$order->transaction_code = $transaction_info['txid'];
	    	
	    	Auth::user()->order()->save($order);
    	endif;

    }

    
    public function getOrderPrice($txid)
    {
    	return DB::table('orders')->where('transaction_code', $txid)->first();
    }
    
    
    public function orderExists($txid)
    {
    	return DB::table('orders')->where('transaction_code', $txid)->count();
    }


    public function selfDecline($order_id)
    {
        return DB::table('orders')->where('order_id', '=', $order_id)->delete();
    }


    public function update($user_id, $tx_id, Array $transaction_info)
    {
        return User::find($user_id)
            ->order()
            ->where('transaction_code', $tx_id)
            ->update($transaction_info);
//        return DB::table('orders')->where('transaction_code', $tx_id)
//            ->update($transaction_info);
    }


    public function getTransactionID()
    {
        return 'QUICSMS01'.rand(10000, 99999);
    }


    public function getPrice($quantity, $unit_price)
    {
        return $quantity * $unit_price;
    }


    public function priceToKobo($price)
    {
        return $price * 100;
    }


    public function priceToNaira($price)
    {
        return $price/100;
    }


    public function genOrderNumber()
    {
        return substr(md5(microtime()), rand(0, 26), 3) .time();
    }
}