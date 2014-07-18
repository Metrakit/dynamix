<?php

class Blog extends Eloquent{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'blogs';

	/**
     * A Blog has many Permission
     *
     * @return mixed
     */
	public function articles() {
        return $this->belongsToMany('Article');
    }

    /**
     * A Blog has one structure
     *
     * @return mixed
     */
	public function structure() {
        return $this->belongsToMany('Structure');
    }
}