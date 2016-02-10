<?php

namespace App\Repository;


use App\Models\Transaction;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionRepository {



    public static function verified($transaction_code, $user_id)
    {
        DB::table('transactions')
            ->where('transaction_code', $transaction_code)
            ->where('user_id', $user_id)
            //->where('status', 'approved')
            ->update([
                'verified'      => 1,
                'verified_date' => Carbon::now(),
            ]);
    }


    public function save(Array $r, $user_id)
    {
        //do two things
        //1, if a transaction row exists, update it
        $check = User::find($user_id)
                    ->transaction();
        $check2 = $check->where('transaction_code', $r['transaction_code']);

        if ( $check2->count() == 1 )
        {
            //update
            return $check2->update($r);
        }
        else
        {
            $t = new Transaction();
            $t->mode = $r['mode'];
            $t->status = $r['status'];
            $t->transaction_code = $r['transaction_code'];
            $t->transaction_ref = $r['transaction_ref'];

            return $check->save($t);
        }


//        //1, insert a new transaction row
//        if ( Auth::user()
//                ->transaction()
//                ->where('transaction_code', $r['transaction_code'])->count() == 1 )
//        {
//            return Auth::user()->transaction()->where('transaction_code', $r['transaction_code'])->update($r);
//        } else {
//
//            $t = new Transaction();
//            $t->mode = $r['mode'];
//            $t->status = $r['status'];
//            $t->transaction_code = $r['transaction_code'];
//            $t->transaction_ref = $r['transaction_ref'];
//
//            return Auth::user()->transaction()->save($t);
//        }


    }



    public static function checkTransaction($code, $user_id)
    {
        return DB::table('transactions')
            ->where('transaction_code', $code)
            ->where('user_id', $user_id)->first();
    }

} 