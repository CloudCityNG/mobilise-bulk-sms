<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class PaymentsController extends Controller {


    //send payment


    //process response
    public function processResponse(Request $request)
    {
        $success = $request->get('success');
        $paymentId = $request->get('paymentId');
        $token = $request->get('token');
        $PayerID = $request->get('PayerID');

        echo 'Success: '.$success . "<br/>",
            'paymentID: '.$paymentId . "<br/>",
            'PayerID: '.$PayerID;

    }

}
