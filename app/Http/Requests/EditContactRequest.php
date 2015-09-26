<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class EditContactRequest extends Request {

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
            'firstname' => 'required|string|min:3|max:20',
            'lastname'  => 'string|min:1|max:20',
            'email'     => 'email',
            'gsm'       => "required|max:16|min:10",
            'birthdate' => 'date_format:"Y/m/d"',
            'custom'    => 'min:1'
		];
	}

}
