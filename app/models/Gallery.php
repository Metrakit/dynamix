<?php

class Gallery extends Eloquent
{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'galleries';

	/**
     * A Role is on one slider
     *
     * @return mixed
     */
    public function images() {
        return $this->belongsToMany('Image');
    }

    /**
     * A Role is on many Permission
     *
     * @return mixed
     */
    public function structure() {
        return $this->hasOne('Structure');
    }
}