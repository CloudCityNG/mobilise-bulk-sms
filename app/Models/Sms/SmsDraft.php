<?php namespace App\Models\Sms;

use Illuminate\Database\Eloquent\Model;

class SmsDraft extends Model {

	protected $table = 'sms_draft';
    protected $fillable = ['sender','recipients','message','flash','schedule'];


    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Pre-store a new row for the sms_draft table.
     *
     * @param array $request
     * @return static
     */
    public static function store(Array $request)
    {
        return new static($request);
    }

}
