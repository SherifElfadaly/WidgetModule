<?php namespace App\Modules\Widget\Http\Requests;

use App\Http\Requests\Request;


class WidgetFormRequest extends Request {

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
		'slug'        => 'required|max:150|unique:content_items,id,' . $this->get('id'),
		'title'       => 'required|max:255',
		'description' => 'required|max:255',
		'link'        => 'url|max:150',
		];
	}

}
