<?php
/**
 * Created by PhpStorm.
 * User: segun
 * Date: 2/4/2016
 * Time: 1:16 PM
 */

namespace App\Lib\Sms;


use App\Repository\OrderRepository;
use Illuminate\Support\Facades\DB;

class CreditUnit {


    public $units;
    private $transaction_code;
    private $user_id;

    /**
     * @param $transaction_code
     * @param $user_id
     */
    function __construct($transaction_code, $user_id)
    {
        $this->transaction_code = $transaction_code;
        $this->user_id = $user_id;

        $row = $this->getUnits();
    }


    private function getUnits()
    {
        $out = DB::table('orders')
            ->where('transaction_code', $this->transaction_code)
            ->where('user_id', $this->user_id)
            ->first();

        $this->units = $out->quantity;
    }
}