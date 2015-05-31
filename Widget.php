<?php namespace App\Modules\Widget;

use Illuminate\Database\Eloquent\Model;

class Widget extends Model {

    /**
     * Spescify the storage table.
     * 
     * @var table
     */
    protected $table    = 'widgets';

    /**
     * Specify the fields allowed for the mass assignment.
     * 
     * @var fillable
     */
    protected $fillable = ['slug', 'image', 'link', 'widget_type_id', 'user_id'];

    /**
     * Get the name that will be displayed in the 
     * menu link.
     * 
     * @return string
     */
    public function getLinkNameAttribute()
    {
        return \CMS::widget()->getWidget($this->attributes['id'])->slug;
    }

    /**
     * Return the gallery object from the
     * stored gallery id of the widget.
     * 
     * @return object
     */
    public function getWidgetImageAttribute()
    {
        return \CMS::galleries()->find($this->attributes['image']);
    }

    /**
     * Get the widget widget type.
     * 
     * @return collection
     */
    public function widgetType()
    {
        return $this->belongsTo('App\Modules\Widget\WidgetTypes', 'widget_type_id');
    }
    
    /**
     * Get the content item user.
     * 
     * @return collection
     */
    public function user()
    {
        return $this->belongsTo('App\Modules\Acl\AclUser');
    }
    
    public static function boot()
    {
        parent::boot();

        /**
         * Remove the translations
         * related to the deleted widget.
         */
        Widget::deleting(function($widget)
        {
            \CMS::languageContents()->deleteItemLanguageContents('widget', $widget->id);
        });
    }
}
