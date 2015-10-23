<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserDetailRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'avatar'    => '',
            'firstname'     => 'alpha',
            'lastname'      => 'alpha',
            'phone'         => 'numeric',
            'dob'           => "date_format:Y-m-d",
            'address'       => 'string',
        ];
    }


    public function messages()
    {
        return [
            'dob.date_format'   => 'Date of Birth should be in YYYY-MM-DD format',
        ];
    }
}
