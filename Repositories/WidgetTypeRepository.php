<?php namespace App\Modules\Widget\Repositories;

use App\AbstractRepositories\AbstractRepository;

class WidgetTypeRepository extends AbstractRepository
{	
	/**
	 * Return the model full namespace.
	 * 
	 * @return string
	 */
	protected function getModel()
	{
		return 'App\Modules\Widget\WidgetTypes';
	}

	/**
	 * Return the module relations.
	 * 
	 * @return array
	 */
	protected function getRelations()
	{
		return ['widgets'];
	}

	/**
	 * Get all widget Types based on the given theme.
	 * If the theme isn't given then get the default
	 * theme.
	 * 
	 * @param  string $theme
	 * @return collection
	 */
	public function getAllWidgetTypes($theme = false)
	{	
		$theme = $theme ?: \CMS::coreModules()->getActiveTheme()->module_key;
		return $this->findBy('theme', $theme);
	}
}
