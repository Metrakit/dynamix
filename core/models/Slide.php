<?php

class Slide extends Eloquent
{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'slides';

	/**
     * A Role is on one slider
     *
     * @return mixed
     */
    public function slider() {
        return $this->belongsTo('Slider');
    }

    /**
     * A Role is on many Permission
     *
     * @return mixed
     */
    public function image() {
        return $this->belongsTo('Image');
    }
}