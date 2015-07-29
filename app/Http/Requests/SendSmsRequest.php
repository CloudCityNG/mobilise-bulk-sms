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
			'sender'        => 'required|max:16',
            'recipients'    => 'required',
            'message'       => 'required',
            'schedule_date' => 'date|date_format:Y-m-d',
            'schedule_time' => 'required_with:schedule_date',
            'flash'         => 'between:0,1',
		];
	}

    public function messages()
    {
        return [
            'sender.required' => 'The Sender Id field cannot be empty',
            'recipients.required' => 'The Recipient field is required',
            'message.required' => 'The Message cannot be empty',
        ];
    }
}
