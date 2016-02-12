<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';
    protected $guarded = ['id'];


    public function user()
    {
        return $this->belongsTo('App\User');
    }


    public function order()
    {
        return $this->belongsTo('App\Models\Order', 'transaction_code', 'transaction_code');
    }
}
