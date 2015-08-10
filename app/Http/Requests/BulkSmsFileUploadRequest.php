<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class BulkSmsFileUploadRequest extends Request {

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
			'bulkSmsFile'   => 'mimes:csv,txt|size:5000',
		];
	}

}
