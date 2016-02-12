<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }


    public function transaction()
    {
        return $this->belongsTo('App\Models\Transaction', 'transaction_code', 'transaction_code');
    }


}
