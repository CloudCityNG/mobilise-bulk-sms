<?php
namespace App\Models\Sms;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SmsHistory extends Model {

    use softDeletes;

	protected $table = "sms_history";
    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];


    public function user()
    {
        return $this->belongsTo('App\User');
    }


    public function smshistoryrecipient()
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