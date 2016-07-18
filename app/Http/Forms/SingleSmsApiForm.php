<?php
/**
 * Created by PhpStorm.
 * User: segun
 * Date: 7/7/2016
 * Time: 1:02 AM
 */

namespace App\Http\Forms;


use Illuminate\Support\Facades\Validator;

class SingleSmsApiForm extends Form
{
    /**
     * Validation rules for the form.
     *
     * @var array
     */
    protected $rules = [
        'auth' => 'required|auth',
    ];


    protected $messages = [
        'auth.required' => 'Empty Username/password',
        'auth.auth' => 'Wrong Auth',
    ];


    /**
     * Persist the form.
     */
    public function persist()
    {

    }


    protected function isValid()
    {
        $validator = Validator::make($this->request->all(), $this->rules, $this->messages);
        /**
         * Buid error message
         */
        if ($validator->fails()):

            $response = [
                "response" => [],
            ];

            if ($validator->errors()->has('auth'))
            {
                //dd($validator->errors()->messages()["auth"][0]);
                //$response["response"]["auth"] = $validator->errors()->messages()['auth'][0];
            }

                //dd(json_encode($validator->errors()->messages()));

            return response()->json($response);
        endif;
    }
}