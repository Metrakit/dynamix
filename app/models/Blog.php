<?php

class Blog extends Eloquent{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'blogs';

	/**
     * An Action is on many Permission
     *
     * @return mixed
     */
	public function articles() {
        return $this->belongsToMany('Article');
    }
}