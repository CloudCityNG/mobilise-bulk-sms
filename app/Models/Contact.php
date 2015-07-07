<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model {

	protected $table = 'sms_contacts';
    protected $guarded = ['id','user_id'];


    public function user()
    {
        return $this->belongsTo('App\User');
    }


    public static function store(Array $input)
    {
        return new static($input);
    }

}
