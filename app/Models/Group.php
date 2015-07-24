<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model {

    protected $table = 'groups';
    protected $guarded = ['id','user_id'];


    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function contacts()
    {
        return $this->belongsToMany('App\Models\Contact', 'contact_group');
    }


    public static function store(Array $inputs)
    {
        return new static($inputs);
    }

} 