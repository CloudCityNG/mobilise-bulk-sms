<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\PricingRequest;
use App\Models\Pricing;
use Illuminate\Http\Request;

class PricingController extends Controller {


    function __construct()
    {
        $this->middleware('auth');
    }

    public function pricing()
    {
        return view('admin.pricing.index', ['data'=>Pricing::getAllRows()]);
    }


    public function postPricing(PricingRequest $request)
    {
        if ($request->ajax())
        {
            Pricing::create($request->only('idn','lower_range','upper_range','unit_price'));
            //return complete table list of existing records.
            $out = view('ajax.pricing', ['data'=>Pricing::getAllRows()])->render();
            return response()->json(['success' => true, 'out' => $out]);
        }
    }


}
