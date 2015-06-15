<?php
namespace App\Models\Sms;

use Illuminate\Database\Eloquent\Model;

class SmsHistory extends Model {

	protected $table = "sms_history";
    protected $guarded = ['id'];


    public function user()
    {
        return $this->belongsTo('App\User');
    }


    public function smsHistoryRecipient()
    {
        return $this->hasMany('App\Models\Sms\SmsHistoryRecipient');
    }


    /**
     * @param $sender
     * @param $message
     * @param $schedule
     * @param $units
     * @param int $flash
     * @return static
     */
    public static function store($sender, $message, $schedule, $units, $flash=0)
    {
        $store = new static( compact('sender', 'message', 'schedule', 'units', 'flash') );
        return $store;
    }

}