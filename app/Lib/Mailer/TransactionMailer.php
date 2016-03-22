<?php

namespace App\Lib\Mailer;


use App\User;

class TransactionMailer extends Mailer {




    public function __construct()
    {

    }


    public function no_transaction_code($user, $transaction_code)
    {
        $view = 'emails.transaction.no_transaction_code';
        $data = ['username'=>$user->username, 'transaction_code'=>$transaction_code];
        $subject = "No Transaction Code";
        $user = (Object) (['email'=>env('MAIL_FROM_ADDRESS'), 'cc'=>env('MAIL_CC_FROM_ADDRESS')]);

        return $this->sendNow($user, $subject, $view, $data);

    }



    public function transaction_already_verified($user, $transaction_code)
    {
        $view = 'emails.transaction.transaction_already_verified';
        $data = ['username'=>$user->username, 'transaction_code'=>$transaction_code];
        $subject = "Transaction Code Already Verified";
        $user = (Object) (['email'=>env('MAIL_FROM_ADDRESS'), 'cc'=>env('MAIL_CC_FROM_ADDRESS')]);

        return $this->sendNow($user, $subject, $view, $data);
    }


    public function user_account_credited(User $user, $transaction_code, $units, $amount)
    {
        $view = "emails.user.account_credited";
        $data = [
            'units'=>$units,
            'username'=>$user->username,
            'balance'=>$user->smscredit->available_credit,
            'amount'=>$amount,
            'payment_channel'=>'WEB',
            'transaction_code'=>$transaction_code,

        ];
        $subject = "Your Account has been credited.";
        $user = (Object) (['email'=>$user->email, 'cc'=>env('SUPPORT_EMAIL')]);

        return $this->sendTo($user, $subject, $view, $data);
    }


    public function verified_failed($user, $transaction_code)
    {
        $view = 'emails.transaction.verified_failed';
        $data = ['username'=>$user->username, 'transaction_code'=>$transaction_code];
        $subject = "Transaction Verification Failed";
        $user = (Object) (['email'=>env('MAIL_FROM_ADDRESS'), 'cc'=>env('MAIL_CC_FROM_ADDRESS')]);

        return $this->sendNow($user, $subject, $view, $data);
    }


} 