<?php
/**
 * Created by PhpStorm.
 * User: segun
 * Date: 7/20/2016
 * Time: 12:51 PM
 */

namespace App\Http\Forms;


use App\Models\Sms\SmsDraft;
use Illuminate\Support\Facades\Auth;

class DraftSmsForm extends Form
{

    protected $rules = [
        'sender' => 'required',
        'recipients' => '',
        'message' => 'required',
        'schedule' => 'boolean',
        'date' => 'date|after:yesterday|required_with:schedule',
        'time' => 'required_with:schedule',
        'timezone' => 'required_with:schedule',
        'flash' => 'boolean'
    ];


    protected $messages = [];


    private function prepare()
    {
        $datetime = "$this->date $this->time $this->timezone";
        $datetime = new \DateTime($datetime);
        $datetime->setTimezone(
            new \DateTimeZone('UTC')
        );
        $datetime = $datetime->format('Y-m-d H:i:s');

        if (!is_null($this->schedule)) {
            $this->request->merge([
                'schedule' => $datetime,
            ]);
        }
    }


    public function persist()
    {
        $this->prepare();
        //Insert into the database
        return Auth::user()->draftsms()->save(
            SmsDraft::store($this->fields())
        );
    }
}