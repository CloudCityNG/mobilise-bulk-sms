<?php

namespace App\Repository;


use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class TransactionRepository {


    public function save(Array $r)
    {
        if ( Auth::user()
                ->transaction()
                ->where('transaction_code', $r['transaction_code'])->count() == 1 )
        {
            return Auth::user()->transaction()->update($r);
        } else {

            $t = new Transaction();
            $t->mode = $r['mode'];
            $t->status = $r['status'];
            $t->transaction_code = $r['transaction_code'];
            $t->transaction_ref = $r['transaction_ref'];

            return Auth::user()->transaction()->save($t);
        }


    }



    public function checkTransaction($code)
    {
        return Auth::user()
            ->transaction()
            ->where('transaction_code', $code)
            ->first();
    }

} 