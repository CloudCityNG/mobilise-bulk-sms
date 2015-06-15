<?php
namespace App\Lib\Sms;


use Illuminate\Database\Eloquent\Model;

class SmsCredit extends Model {

    protected $table = 'sms_credit';
    protected $guarded = ['id'];


    public function user()
    {
        return $this->belongsTo('App\User');
    }
} 