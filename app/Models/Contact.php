<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model {

	protected $table = 'contacts';
    protected $guarded = ['id','user_id'];


    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function groups()
    {
        return $this->belongsToMany('App\Models\Group', 'contact_group');
    }


    public static function store(Array $input)
    {
        return new static($input);
    }

}
