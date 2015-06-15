<?php namespace App\Models\Sms;

use Illuminate\Database\Eloquent\Model;

class SmsCreditUsage extends Model {

	protected $table = 'sms_credit_usage_history';
    protected $fillable = ['user_id','sms_history_id','used_units','comment'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
