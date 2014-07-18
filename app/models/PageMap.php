<?php

class PageMap extends Eloquent {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'page_maps';

    /**
     * A PageMap has one page
     *
     * @return mixed
     */
	public function page() {
        return $this->hasOne('Page');
    }

	/**
     * A PageMap has one view
     *
     * @return mixed
     */
	public function view() {
        return $this->hasMany('View');
    }
}