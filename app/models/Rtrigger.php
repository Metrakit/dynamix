<?php

class Rtrigger extends Eloquent{
	
	/**
	 * Parameters
	 */
	protected $table = 'responsive_triggers';
	public $timestamps = false;

	
	/**
	 * Relations
	 *
	 * @var string
	 */
	public function responsives() {
        return $this->hasMany('Responsive');
    }


    /**
     * Attributes
     *
     * @return mixed
     */

}