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


    public function processReturn(Array $return)
    {
        $r = array_map('trim', $return);


        if (!empty($r['action']) && $r['action'] == 'decline' && !empty($r['order']))
        {
            flash()->error(self::declined, "Transaction Declined");
            return redirect()->to(self::purchase_url);
        }

        $a = array_except($r, ['transaction_code']);
        $t = create_object($r);

        //create transaction
        if( $r['transaction_ref'] )
            $this->transactionRepository->save($r);

        switch(true)
        {
            //declined
            case ( $t->mode == self::card && $t->status == 'declined' && !empty($t->transaction_code) && !empty($t->transaction_ref) ):
                //update order
                if ( $this->orderRepository->update($t->transaction_code, $a) ):
                    flash()->error(self::declined, 'Transaction Error');
                else:
                    flash()->error(self::invalid);
                endif;
                break;

            //approved
            case ( $t->mode == self::card && $t->status == 'approved' && !empty($t->transaction_code) && !empty($t->transaction_ref)):
                //update order
                if ( $this->orderRepository->update($t->transaction_code, $a) ):
                    flash()->success(self::successful);
                else :
                    flash()->error(self::invalid);
                endif;
                break;

            default:
                flash()->error(self::declined);
                break;
        }

        return redirect()->to(self::purchase_url);
    }

} 