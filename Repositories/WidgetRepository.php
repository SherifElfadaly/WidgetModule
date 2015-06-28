<?php namespace App\Modules\Widget\Repositories;

use App\Modules\Core\AbstractRepositories\AbstractRepository;

class WidgetRepository extends AbstractRepository
{	
	/**
	 * Return the model full namespace.
	 * 
	 * @return string
	 */
	protected function getModel()
	{
		return 'App\Modules\Widget\Widget';
	}

	/**
	 * Return the module relations.
	 * 
	 * @return array
	 */
	protected function getRelations()
	{
		return ['widgetType'];
	}

	/**
	 * Get all widget based on the given widget type 
	 * and language.
	 * 
	 * @param  string  $widgetTypeName
	 * @param  string  $language
	 * @param  integer $perPage
	 * @return collection
	 */
	public function getAllWidgets($widgetTypeName, $language = false, $perPage = 15)
	{	
		$widgetType = \CMS::widgetTypes()->first('widget_type_name', $widgetTypeName);
		if ( ! $widgetType) return [];
		
		$widgets    = \CMS::widgets()->paginateBy('widget_type_id', $widgetType->id, $perPage);

		return $this->getWidgetTranslations($widgets, $language);
	}

	/**
	 * Return the specified widget with translations.
	 * 
	 * @param  integer $id
	 * @param  string  $language
	 * @return object
	 */
	public function getWidget($id, $language = false)
	{
		return $this->getWidgetTranslations($this->find($id), $language);
	}

	/**
	 * Return the widget translated data based on the 
	 * given language , if the obj of type LengthAwarePaginator
	 * then it is a collection of objects else it is a single
	 * object.
	 * 
	 * @param  object or \Illuminate\Pagination\LengthAwarePaginator $obj
	 * @param  string 												 $language
	 * @return object or \Illuminate\Pagination\LengthAwarePaginator
	 */
	public function getWidgetTranslations($obj, $language)
	{
		if ($obj instanceof \Illuminate\Pagination\LengthAwarePaginator) 
		{
			foreach ($obj as $element) 
			{
				$element->data = \CMS::languageContents()->getTranslations($element->id, 'widget', $language);
			}
		}
		else
		{
			$obj->data = \CMS::languageContents()->getTranslations($obj->id, 'widget', $language);
		}
		return $obj;
	}

	/**
	 * Store the widget and it's translations in to the storage.
	 * 
	 * @param  array $data 
	 * @return object
	 */
	public function createWidget($data)
	{	
		$widget = $this->create($data);
		\CMS::languageContents()->insertLanguageContent([
				'title'       => $data['title'],
				'description' => $data['description'],
				], 'widget', $widget->id);

		return $widget;
	}

	/**
	 * Update the widget and it's translations in to the storage.
	 * 
	 * @param  integer $id
	 * @param  array   $data
	 * @return object
	 */
	public function updateWidget($id, $data)
	{
		$this->update($id, $data);
		\CMS::languageContents()->insertLanguageContent([
				'title'       => $data['title'],
				'description' => $data['description'], 
				], 'widget', $id);

		return $this->find($id);
	}

	/**
	 * Return the widget  based on the given widget type 
	 * and language.
	 * 
	 * @param  string $widgetType
	 * @param  string $language
	 * @param  string $path
	 * @return string
	 */
	public function renderWidget($widgetType, $language = false, $path = false)
	{
		$widgets = $this->getAllWidgets($widgetType, $language);
		$html    = '';
		foreach ($widgets as $widget) 
		{
			$themeName     = \CMS::CoreModules()->getActiveTheme()->module_key ;
			$specifiedPath = $themeName . "::" . $path;
			$defaultPath   = $themeName . "::templates.widgets." . $widget->widgetType->template;
			if ($path && view()->exists($specifiedPath))
			{
				$html .= view($specifiedPath, compact('widget'))->render();
			}
			elseif(view()->exists($defaultPath))
			{
				$html .= view($defaultPath, compact('widget'))->render();
			}
		}
		return $html;
	}
}
