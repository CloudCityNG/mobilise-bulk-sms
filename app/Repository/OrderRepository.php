<?php
/**
 * Created by PhpStorm.
 * User: segun
 * Date: 1/26/2016
 * Time: 4:08 PM
 */

namespace App\Repository;


use App\Models\Order;
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


    public function save(Array $transaction_info)
    {
        $order = new Order();
        $order->product_id = $transaction_info['poid'];
        $order->order_id = $transaction_info['order_number'];
        $order->quantity = $transaction_info['quantity'];
        $order->unit_price = $transaction_info['unit_price'];
        $order->price = $transaction_info['price'];
        $order->item = $transaction_info['item'];
        $order->transaction_code = $transaction_info['txid'];


        Auth::user()->order()->save($order);

    }


    public function selfDecline($order_id)
    {
        return DB::table('orders')->where('order_id', '=', $order_id)->delete();
    }


    public function update($order_id, Array $transaction_info)
    {

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