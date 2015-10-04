<?php
namespace App\Lib\Payments\PayPal;


use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;

class Start {



    public function start()
    {
        $payPal = new ApiContext( new OAuthTokenCredential(
            'AaJv8UrvcrrhD-UNsUdD76xbKDqcZzkYp_OTKPDpff54-_ymlEpggyl6WektvPJoTpZi78mX1DqsAw3F',
            'EMWqs3A3msShREuw2mZ11Qa1z4xhFTuTTjcJtkJHxK_7MJnBxhLlpTWIe4U__bYDcnQkByM6EBULsQIs'
        ) );

        return $payPal;
    }

} 