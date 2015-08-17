<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class SendSmsRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
        //check credits here.
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
			'sender'        => 'required|max:14',
            'recipients'    => 'required',
            'message'       => 'required|min:1',
            'schedule'      => 'date_format:"Y-m-d H:i"|schedule',
            'flash'         => 'between:0,1',
		];
	}

    public function messages()
    {
        return [
            'sender.required'       => 'The Sender Id field cannot be empty',
            'recipients.required'   => 'The Recipient field is required',
            'message.required'      => 'The Message cannot be empty',
            'schedule.schedule'     => 'The Schedule date is not valid',
            'schedule.date_format'  => 'The Schedule does not match the format YYYY-MM-DD HH:MM'
        ];
    }
}
