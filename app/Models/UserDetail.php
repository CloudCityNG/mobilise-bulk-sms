<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    protected $table = 'users_details';
    protected $guarded = ['id'];
    protected $dates = ['created_at', 'updated_at', 'dob'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
