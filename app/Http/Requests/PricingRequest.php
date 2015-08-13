<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class PricingRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
        //@TODO check for user roles here.
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
			'idn'            => 'required',
			'lower_range'   => 'required',
			'upper_range'   => 'required',
			'unit_price'    => 'required',
		];
	}

}
