<?php

class Rwidth extends Eloquent{
	
	/**
	 * Parameters
	 */
	protected $table = 'responsive_widths';
	public $timestamps = false;

	
	/**
	 * Relations
	 *
	 * @var string
	 */
	public function responsive() {
        return $this->hasMany('Responsive');
    }


    /**
     * Attributes
     *
     * @return mixed
     */

}