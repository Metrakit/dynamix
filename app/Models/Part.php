<?php

namespace Dynamix\Models;

class Part extends Model {

	/**
	 * Table name
	 */
	protected $table = 'onepage_parts';

	/**
	 * Relations
	 *
	 * @var string
	 */
	public function onepage() {
        return $this->hasOne('Dynamix\Models\OnePage');
    }

	public function background() {
        return $this->belongsTo('Dynamix\Models\Background');
    }


	
	/**
	 * Additional Method
	 *
	 * @var string
	 */

	public function isDeletable() 
	{
		return $this->deletable;
	}

	public static function getClassName () 
	{
		return get_class();
	}

	public function render () 
	{
		return \Pager::render(Page::find($this->page_id));
	}
}