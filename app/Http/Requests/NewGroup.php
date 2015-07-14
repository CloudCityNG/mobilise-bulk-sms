<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class NewGroup extends Request {

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
			'group_name'        => 'required|string|min:2|max:100',
            'group_description' => 'string'
		];
	}

}
