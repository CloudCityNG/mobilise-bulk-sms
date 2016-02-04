<?php

namespace App\Lib\Mailer;


class TransactionMailer extends Mailer {


    public function no_transaction_code($user, $transaction_code)
    {
        $view = 'emails.transaction.no_transaction_code';
        $data = ['username'=>$user->username, 'transaction_code'=>$transaction_code];
        $subject = "No Transaction Code";
        $user = (Object) (['email'=>env('MAIL_FROM_ADDRESS'), 'cc'=>env('MAIL_CC_FROM_ADDRESS')]);

        return $this->sendTo($user, $subject, $view, $data);

    }



    public function transaction_already_verified($user, $transaction_code)
    {
        $view = 'emails.transaction.transaction_already_verified';
        $data = ['username'=>$user->username, 'transaction_code'=>$transaction_code];
        $subject = "Transaction Code Already Verified";
        $user = (Object) (['email'=>env('MAIL_FROM_ADDRESS'), 'cc'=>env('MAIL_CC_FROM_ADDRESS')]);

        return $this->sendTo($user, $subject, $view, $data);
    }


    public function user_account_credited($user, $transaction_code, $units)
    {
        $view = 'emails.transaction.user_account_credited';
        $data = ['username'=>$user->username, 'transaction_code'=>$transaction_code, 'units'=>$units];
        $subject = "User Account Credited";
        $user = (Object) (['email'=>env('MAIL_FROM_ADDRESS'), 'cc'=>env('MAIL_CC_FROM_ADDRESS')]);

        return $this->sendTo($user, $subject, $view, $data);
    }


} 