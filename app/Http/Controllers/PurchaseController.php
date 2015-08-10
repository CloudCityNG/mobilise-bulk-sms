<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class PurchaseController extends Controller {


    public function creditPurchase()
    {
        return view('user.credit-purchase');
    }

}
