<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pricing extends Model {

	protected $table = 'pricing';
    protected $guarded = ['id'];


    public static function getAllRows()
    {
        return DB::table('pricing')->select('id','idn','lower_range','upper_range','unit_price')->orderBy('idn')->get();
    }

}
