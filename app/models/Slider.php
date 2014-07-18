<?php

class Slider extends Eloquent
{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'sliders';

	/**
     * A Role is on one slider
     *
     * @return mixed
     */
    public function slides() {
        return $this->hasMany('Slide');
    }

}