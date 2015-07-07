<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class NewContact extends Request {

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
			'gsm'       => 'required|max:16|min:10|unique:sms_contacts,gsm',
			'gsm2'      => 'max:16|min:10|unique:sms_contacts,gsm2',
			'email'     => 'email|min:5',
			'firstname' => 'string|min:1|max:20',
			'lastname'  => 'string|min:1|max:20',
			'street'    => 'max:100',
			'city'      => 'string|max:25',
			'region'    => 'string|max:50',
			'postcode'  => 'numeric',
			'birthdate' => 'date_format:"Y/m/d"',
			'company'   => 'string|max:100',
			'url'       => 'url',
			'country'   => 'max:100',
			'data1'     => 'max:250',
			'data2'     => 'max:250',
		];
	}


    public function messages()
    {
        return [
            'gsm.required'      => 'The GSM number is required.',
            'gsm.unique'        => 'The GSM number already exists.',
            'firstname.string'  => 'FirstName must be a string.',
            'email.email'       => 'The email is not in the correct format.'

        ];
    }

}
