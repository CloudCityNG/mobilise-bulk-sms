<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class NewUserRegistrationRequest extends Request {

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
			'username'              => 'required|min:6|alpha_dash|unique:users,username',
            'email'                 => 'required|email|unique:users,email',
            'password'              => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
		];
	}

    public function messages()
    {
        return [
            'username.alpha_dash'   => 'Username must be alphanumeric with dashes and underscores',
            'username.unique'       => 'Username exists already, Please use another',
            'email.unique'       => 'Email address is taken, Please use another',
        ];
    }

}
