<?php

class Part extends Eloquent {

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
        return $this->hasOne('OnePage');
    }

	public function background() {
        return $this->belongsTo('Background');
    }


	
	/**
	 * Additional Method
	 *
	 * @var string
	 */

	public function isDeletable() {
		return $this->deletable;
	}

	public static function getClassName () {
		return get_class();
	}

	public function render () {
		return Pager::render(Page::find($this->page_id));
	}
}