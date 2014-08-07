<?php

class Mosaic extends Eloquent
{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'mosaics';

	/**
     * A Role is on one slider
     *
     * @return mixed
     */
    public function galleries() {
        return $this->belongsToMany('Gallery');
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