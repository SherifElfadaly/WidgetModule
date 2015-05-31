<?php namespace App\Modules\Widget\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Modules\Widget\Http\Requests\WidgetTypeFormRequest;

class WidgetTypesController extends BaseController {

	/**
	 * Create new WidgetTypesController instance.
	 */
	public function __construct()
	{
		parent::__construct('WidgetTypes');
	}

	/**
	 * Display a listing of the widget types.
	 * 
	 * @return respnonse
	 */
	public function getIndex()
	{
		$widgetTypes = \CMS::widgetTypes()->getAllWidgetTypes();
		return view('widget::widgettypes.viewwidgettypes', compact('widgetTypes'));
	}
}