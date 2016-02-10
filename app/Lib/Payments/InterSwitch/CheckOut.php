<?php

namespace App\Lib\Payments\InterSwitch;


use App\Repository\OrderRepository;
use App\Repository\TransactionRepository;

class CheckOut {


    const declined = 'Your Transaction was declined. Please try again.';
    const self_declined = 'You declined the transaction. You can try again';
    const invalid = 'Invalid Transaction/Order';
    const successful = 'Your payment was successful. Your account has been recharged';
    const purchase_url = 'user/credit-purchase';
    const card = 'card';
    /**
     * @var OrderRepository
     */
    private $orderRepository;
    /**
     * @var TransactionRepository
     */
    private $transactionRepository;


    function __construct(OrderRepository $orderRepository, TransactionRepository $transactionRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->transactionRepository = $transactionRepository;
    }


    public function process()
    {

    }


    public function verified($transaction_code, $user_id)
    {
        $this->transactionRepository->verified($transaction_code, $user_id);
    }


    public function confirmTransaction($transaction_code, $user_id)
    {
        return $this->transactionRepository->checkTransaction($transaction_code, $user_id);
        //dd($row);
    }


    /**
     * Confirm a transaction from the gateway
     * @param array $in
     * @param $out
     */
    public static function verifyTransaction(Array $in, &$out)
    {
        $url = "https://oameye.works.payments.payquic.com/checkout/verifytrans.php";
        $post_data = http_build_query($in);

        //open connection
        $ch = curl_init();

        //set the url, number of POST vars, POST data
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_POST,count($in));
        curl_setopt($ch,CURLOPT_POSTFIELDS,$post_data);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        //execute post
        $result = curl_exec($ch);

        //close connection
        curl_close($ch);

        // Parse result
        foreach(explode("\n", $result) as $line) {
            if ($line=="" || strpos($line,"=") === false ) continue;
            $key = trim(strtok($line,"="));
            if ($key!="") {
                $out[$key] = base64_decode(substr($line,1+strlen($key)));
            }
        }
    }


    public function processReturn(Array $return, $user_id)
    {
        $r = array_map('trim', $return);//['mode'=>'','status'=>'','transaction_code'=>'','transaction_ref'=>'']

        //check first if all the request coming in exists


        if (!empty($r['action']) && $r['action'] == 'decline' && !empty($r['order']))
        {
            flash()->error(self::declined, "Transaction Declined");
            return redirect()->to(self::purchase_url);
        }

        $a = array_except($r, ['transaction_code']); //['mode'=>'','status'=>'','transaction_ref'=>'']
        $t = create_object($r);

        //create transaction
        if( $r['transaction_ref'] )
            $this->transactionRepository->save($r, $user_id);

        $out = null;

        switch(true)
        {
            //declined
            case ( $t->mode == self::card && $t->status == 'declined' && !empty($t->transaction_code) && !empty($t->transaction_ref) ):
                //update order
                if ( $this->orderRepository->update($user_id, $t->transaction_code, $a) ):
                    flash()->error(self::declined, 'Transaction Error');
                else:
                    flash()->error(self::invalid);
                endif;
                break;

            //approved
            case ( $t->mode == self::card && $t->status == 'approved' && !empty($t->transaction_code) && !empty($t->transaction_ref)):
                //update order
                if ( $this->orderRepository->update($user_id, $t->transaction_code, $a) ):
                    flash()->success(self::successful);
                    $out = true;
                    //do a job to confirm the transaction.
                    //the job should then update the balance after successful confirmation.
                else :
                    flash()->error(self::invalid);
                endif;
                break;

            default:
                flash()->error(self::declined);
                break;
        }

        //return redirect()->to(self::purchase_url);
        return $out;
    }

} 