<?php
namespace App\Lib\Payments\PayPal;

use League\Flysystem\Exception;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;

class CheckOut {


    const returnURL = 'http://lara.app/Payments/PayPal/?success=true';
    const cancelUrl = 'http://lara.app/Payments/PayPal/?success=false';
    const intent = 'sale';
    const description = 'Payment for Bulk-SMS Purchase';
    const currency = 'USD';
    const paymentMethod = 'paypal';

    /**
     * @var Payer
     */
    private $payer;
    /**
     * @var Item
     */
    private $item;
    /**
     * @var ItemList
     */
    private $itemList;
    /**
     * @var Details
     */
    private $details;
    /**
     * @var Amount
     */
    private $amount;
    /**
     * @var Transaction
     */
    private $transaction;
    /**
     * @var RedirectUrls
     */
    private $redirectUrls;
    /**
     * @var Payment
     */
    private $payment;
    /**
     * @var Start
     */
    private $start;

    public function __construct(Payer $payer, Item $item, ItemList $itemList, Details $details, Amount $amount, Transaction $transaction, RedirectUrls $redirectUrls, Payment $payment, Start $start
    )
    {

        $this->payer = $payer;
        $this->item = $item;
        $this->itemList = $itemList;
        $this->details = $details;
        $this->amount = $amount;
        $this->transaction = $transaction;
        $this->redirectUrls = $redirectUrls;
        $this->payment = $payment;
        $this->start = $start;
    }

    public function process($values)
    {
        $this->payer->setPaymentMethod(self::paymentMethod);

        $this->item->setName($values->product)
                    ->setCurrency(self::currency)
                    ->setQuantity($values->quantity)
                    ->setPrice($values->price);

        $this->itemList->setItems([$this->item]);

        $this->details->setShipping($values->shipping)
                        ->setSubtotal($values->price);

        $this->amount->setCurrency(self::currency)
                        ->setTotal($values->total)
                        ->setDetails($this->details);

        $this->transaction->setAmount($this->amount)
                            ->setItemList($this->itemList)
                            ->setDescription(self::description)
                            ->setInvoiceNumber($values->invoiceNumber);

        $this->redirectUrls->setReturnUrl(self::returnURL)
                            ->setCancelUrl(self::cancelUrl);

        $this->payment->setIntent(self::intent)
            ->setPayer($this->payer)
            ->setRedirectUrls($this->redirectUrls)
            ->setTransactions([$this->transaction]);

        try {
            $this->payment->create($this->start->start());
        } catch (Exception $e) {
            die($e);
        }

        try {
            $link = $this->payment->getApprovalLink();
        } catch ( Exception $e ){
            die($e);
        }



        return redirect()->away($link );
    }

} 