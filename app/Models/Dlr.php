<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dlr extends Model {

    protected $table = 'sms_dlr';
    protected $guarded = ['id'];


    public function make(Array $inputs)
    {
        self::create($inputs);
    }
} 