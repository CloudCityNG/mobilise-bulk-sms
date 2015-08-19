<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class BulkSmsRequest extends Request {

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
			'contacts'      => '',
			'groups'        => '',
            'recipients'    => 'required_without_all:groups,contacts',
            'sender'        => 'required',
            'message'       => 'required',
            'schedule'      => 'date_format:"Y-m-d H:i"|schedule',
		];
	}


    public function messages()
    {
        return [
            //'contacts.numeric'
            //'groups.numeric'
            'recipients.required_without'   => 'The Recipient field cannot be empty if no group or contact was selected.',
            'sender.required'               => 'The Sender Id field cannot be empty',
            'message.required'              => 'The Message cannot be empty',
            'schedule.schedule'             => 'The Schedule date is not valid',
            'schedule.date_format'          => 'The Schedule does not match the format YYYY-MM-DD HH:MM'
        ];
    }

}
