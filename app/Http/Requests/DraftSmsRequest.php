<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class DraftSmsRequest extends Request {


    function __construct(\Illuminate\Http\Request $requests)
    {
        empty($requests->get('schedule')) ? $requests->merge(['schedule'=>null]) : null ;
        empty($requests->get('flash')) ? $requests->merge(['flash'=>0]) : null ;
    }


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
            'schedule'      => 'date_format:"Y-m-d H:i"|schedule',
            'flash'         => 'between:0,1',
		];
	}


}
