<?php namespace App\Modules\Widget\Http\Controllers;

use App\Modules\Core\Http\Controllers\BaseController;
use App\Modules\Widget\Http\Requests\WidgetFormRequest;
use Illuminate\Http\Request;

class WidgetsController extends BaseController {

	/**
	 * Specify a list of extra permissions.
	 * 
	 * @var permissions
	 */
	protected $permissions = [
	'getShow' => 'show', 
	];

	/**
	 * Create new WidgetsController instance.
	 */
	public function __construct()
	{
		parent::__construct('Widgets');
	}

 	/**
 	 * Display a listing of the widgets.
 	 * 
 	 * @param  integer $widgetTypeId
 	 * @return response
 	 */
	public function getShow($widgetTypeId)
	{
		$widgetType = \CMS::widgetTypes()->find($widgetTypeId);
		$widgets    = \CMS::widgets()->getAllWidgets($widgetType->widget_type_name);
		$widgets->setPath(url('admin/widget/show', [$widgetTypeId]));

		return view('widget::widgets.viewwidget', compact('widgets', 'widgetType'));
	}

	/**
	 * Show the form for creating a new widget.
	 * 
	 * @return response
	 */
	public function getCreate()
	{
		$widgetImageMediaLibrary = \CMS::galleries()->getMediaLibrary('photo', true, 'widgetImageMediaLibrary');
		return view('widget::widgets.addwidget' ,compact('widgetImageMediaLibrary'));
	}

	/**
	 * Store a newly created widget in storage.
	 * 
	 * @param  WidgetFormRequest $request      
	 * @param  integer           $widgetTypeId 
	 * @return response
	 */
	public function postCreate(WidgetFormRequest $request, $widgetTypeId)
	{
		$data['user_id']        = \Auth::user()->id;
		$data['link']           = strlen(trim($request->link)) ? $request->link : "#";
		$data['link']           = realpath($data['link']) && $data['link'] !== '/' ? $data['link'] : url($data['link']);
		$data['widget_type_id'] = $widgetTypeId;
		$widget                 = \CMS::widget()->createWidget(array_merge($request->all(), $data));

		return redirect()->back()->with('message', 'Widget created succssefuly');
	}

	/**
	 * Show the form for editing the specified widget.
	 * 
	 * @param  integer $id
	 * @return response
	 */
	public function getEdit($id)
	{
		$widget                  = \CMS::widgets()->getWidget($id);
		$widgetImageMediaLibrary = \CMS::galleries()->getMediaLibrary('photo', true, 'widgetImageMediaLibrary');

		return view('widget::widgets.updatewidget', compact('widget', 'widgetImageMediaLibrary'));
	}

	/**
	 * Update the specified widget in storage.
	 * 
	 * @param  WidgetFormRequest $request
	 * @param  integer            $id
	 * @return response
	 */
	public function postEdit(WidgetFormRequest $request, $id)
	{
		$data['link'] = strlen(trim($request->link)) ? $request->link : "#";
		$data['link'] = realpath($data['link']) && $data['link'] !== '/' ? $data['link'] : url($data['link']);
		$widget       = \CMS::widgets()->updateWidget($id, array_merge($request->all(), $data));
		return redirect()->back()->with('message', 'Widget updated succssefuly');
	}

	/**
	 * Remove the specified widget from storage.
	 * 
	 * @param  integer $id
	 * @return response
	 */
	public function getDelete($id)
	{
		\CMS::widgets()->delete($id);
		return redirect()->back()->with('message', 'Widget Deleted succssefuly');
	}

	/**
	 * Return a gallery array from the given ids,
	 * handle the ajax request for inserting galleries
	 * to the widget.
	 * 
	 * @param  Request $request
	 * @return collection
	 */
	public function getWidgetgalleries(Request $request)
	{
		return \CMS::galleries()->getGalleries($request->input('ids'));
	}
}