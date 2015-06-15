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
        $now = date('Y-m-d H:i:s', time());
		return [
            'sender'        => 'required|alpha',

			'recipients'    => 'required|string|min:11',
            'message'       => 'string|min:1',
            'schedule'      => "after:$now",
            'flash'         => 'between:0,1',
		];
	}

}
