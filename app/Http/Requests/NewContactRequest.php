<?php namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;

class NewContactRequest extends Request {

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
        $id = Auth::user()->id;
        return [
            'firstname' => 'required|string|min:3|max:20',
            'lastname'  => 'string|min:1|max:20',
            'email'     => 'email',
            'gsm'       => "required|max:16|min:10|unique:contacts,gsm,null,id,user_id,$id",
            'gsm2'      => 'max:16|unique:contacts,gsm,null,id,user_id,$id|unique:contacts,gsm2,null,id,user_id,$id',
            'birthdate' => 'date_format:"Y/m/d"',
            'custom'    => 'min:1'
        ];
    }

    public function messages()
    {
        return [
            'gsm.required'      => 'The GSM number is required.',
            'gsm.unique'        => 'The GSM number already exists.',
            'firstname.string'  => 'FirstName must be a string.',
            'email.email'       => 'The email is not in the correct format.',
            'custom.min'        =>  'Custom cannot ber empty.'

        ];
    }

}
