<?php
namespace App\Models\Sms;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SmsCredit extends Model {

	protected $table = 'sms_credit';
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }


    public static function billUserSmsCredit($units, $userId)
    {
        return DB::table('sms_credit')
            ->where('user_id',$userId)
            ->decrement('available_credit', $units)
            ;
    }
}
