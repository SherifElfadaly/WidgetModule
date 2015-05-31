<?php namespace App\Modules\Widget;

use Illuminate\Database\Eloquent\Model;

class WidgetTypes extends Model {

	/**
     * Spescify the storage table.
     * 
     * @var table
     */
	protected $table    = 'widget_types';

    /**
     * Specify the fields allowed for the mass assignment.
     * 
     * @var fillable
     */
	protected $fillable = ['widget_type_name', 'template', 'theme'];

	/**
	 * Get the name that will be displayed in the 
	 * menu link.
	 * 
	 * @return string
	 */
	public function getLinkNameAttribute()
	{
		return $this->attributes['widget_type_name'];
	}

	/**
     * Get the widget type widgets.
     * 
     * @return collection
     */
	public function widgets()
	{
		return $this->hasMany('App\Modules\Widget\Widget', 'widget_type_id');
	}

	public static function boot()
	{
		parent::boot();

		/**
         * Remove the widgets related
         * to the deleted widget type.
         */
		WidgetTypes::deleting(function($widgetTypes)
		{
			$widgetTypes->widgets()->delete();
		});
	}
}
