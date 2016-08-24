<?php
namespace App\Models\Sms;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class SmsHistoryRecipient extends Model {

    protected $table = "sms_history_recipients";
    protected $guarded = ['id'];
    protected $dates = ['deleted_at','updated_at', 'created_at'];


    public function smshistory()
    {
        return $this->belongsTo('App\Models\Sms\SmsHistory');
    }


    public static function store($status, $messageid, $destination)
    {
        return new static( compact('status', 'messageid', 'destination') );
    }
} 