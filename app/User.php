<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Support\Facades\Hash;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['username', 'email', 'password'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];


    /**
     * @param $password
     */
//    public function setPasswordAttribute($password)
//    {
//        $this->attributes['password'] = Hash::make($password);
//    }



    /**
     * SentSmsHistory relationship
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function smshistory()
    {
        return $this->hasMany('App\Models\Sms\SmsHistory', 'user_id', 'id');
    }

    public function smscredit()
    {
        return $this->hasOne('App\Models\Sms\SmsCredit');
    }

    public function smscreditusage()
    {
        return $this->hasMany('App\Models\Sms\SmsCreditUsage');
    }

    public function draftsms()
    {
        return $this->hasMany('App\Models\Sms\SmsDraft');
    }


    public function contacts()
    {
        return $this->hasMany('App\Models\Contact');
    }


    public function groups()
    {
        return $this->hasMany('App\Models\Group');
    }

}
