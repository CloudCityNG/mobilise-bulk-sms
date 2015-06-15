<?php
namespace App\Models\Sms;

use Illuminate\Database\Eloquent\Model;


class SmsHistoryRecipient extends Model {

    protected $table = "sms_history_recipients";
    protected $guarded = ['id'];


    public function smsHistory()
    {
        return $this->belongsTo('App\Models\Sms\SmsHistory');
    }


    public static function store($status, $messageid, $destination)
    {
        return new static( compact('status', 'messageid', 'destination') );
    }
} 