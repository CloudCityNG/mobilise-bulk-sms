<?php

namespace App\Models\Sms;

use Illuminate\Database\Eloquent\Model;

class SmsPurchase extends Model
{
    protected $table = "sms_purchase";
    protected $guarded = ['id'];
    
    
    public function user() {
    	return $this->belongsTo('App\User');
    }
    
    
    public static function logPurchase($amount, $units, $transaction_id, $user_id)
    {
    	return self::create([
    			'amount'			=> $amount,
    			'units'				=> $units,
    			'transaction_id'	=> $transaction_id,
    			'user_id'			=> $user_id,
    	]);
    }
}
