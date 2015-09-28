<?php
namespace App\Lib\Payments\PayPal;


use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;

class Start {

    public static function start(ApiContext $apiContext, OAuthTokenCredential $authTokenCredential)
    {
        $payPal = new ApiContext( new OAuthTokenCredential(
            '',
            ''
        ) );

        return $payPal;
    }

} 