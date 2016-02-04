<?php

namespace App\Repository;


use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionRepository {


    public function save(Array $r)
    {
        if ( Auth::user()
                ->transaction()
                ->where('transaction_code', $r['transaction_code'])->count() == 1 )
        {
            return Auth::user()->transaction()->where('transaction_code', $r['transaction_code'])->update($r);
        } else {

            $t = new Transaction();
            $t->mode = $r['mode'];
            $t->status = $r['status'];
            $t->transaction_code = $r['transaction_code'];
            $t->transaction_ref = $r['transaction_ref'];

            return Auth::user()->transaction()->save($t);
        }


    }



    public static function checkTransaction($code, $user_id)
    {
        return DB::table('transactions')
            ->where('transaction_code', $code)
            ->where('user_id', $user_id)->first();
    }

} 