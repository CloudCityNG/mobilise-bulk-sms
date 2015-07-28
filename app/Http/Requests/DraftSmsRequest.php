<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class DraftSmsRequest extends Request {

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
            'sender'        => 'required',
			'recipients'    => 'required|string|min:11',
            'message'       => 'required|string|min:1',
            'schedule_date' => "date_format:Y-m-d",
            'schedule_time' => "required_with:schedule_date",
            'flash'         => 'between:0,1',
		];
	}

}
