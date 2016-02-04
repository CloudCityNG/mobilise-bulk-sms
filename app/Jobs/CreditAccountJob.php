<?php

namespace App\Jobs;

use App\Jobs\Job;
use App\Lib\Mailer\TransactionMailer;
use App\Lib\Payments\InterSwitch\CheckOut;
use App\Lib\Sms\CreditUnit;
use App\Repository\SmsCreditRepository;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;

class CreditAccountJob extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;
    /**
     * @var
     */
    private $transaction_code;
    /**
     * @var
     */
    private $transaction_ref;
    /**
     * @var
     */
    private $user;

    /**
     * Create a new job instance.
     *
     * @param $transaction_code
     * @param $transaction_ref
     * @param $user
     * @return \App\Jobs\CreditAccountJob
     */
    public function __construct($transaction_code, $transaction_ref, $user)
    {
        //
        $this->transaction_code = $transaction_code;
        $this->transaction_ref = $transaction_ref;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @param CheckOut $checkOut
     * @param SmsCreditRepository $creditRepository
     * @param TransactionMailer $mailer
     * @return void
     */
    public function handle(CheckOut $checkOut, SmsCreditRepository $creditRepository, TransactionMailer $mailer)
    {
//        if ($this->attempts() > 2) {
//            return;
//        }

        //check if the transaction has been processed already
        $row = $checkOut->confirmTransaction($this->transaction_code, $this->user->id);

        if ( $row === null )
        {
            //we can't find the transaction_code
            //send an email
            $mailer->no_transaction_code($this->user, $this->transaction_code);
        }

        if ( $row->verified == 1 )
        {
            //transaction already verified
            $mailer->transaction_already_verified($this->user, $this->transaction_code);
            return;
        }
        else
        {
            //confirm the transaction
            $out = null;
            $checkOut->verifyTransaction([
                'transaction_code'=>$this->transaction_code,
                'transaction_ref'=>$this->transaction_ref], $out);

            if ( !empty($out['verifyid']) && $out['ResponseCode'] == "00" )
            {
                //transaction successful from extra verification

                $units = new CreditUnit($this->transaction_code, $this->user->id);

                //update customer balance
                $creditRepository->creditUser($units, $this->user->id);

                //log the credit update

                //send email to user

                //send email to admin
                $mailer->user_account_credited($this->user, $this->transaction_code, $units->units);
            }
            else
            {
                //transaction was not successful from extra verification
            }

        }

    }
}
