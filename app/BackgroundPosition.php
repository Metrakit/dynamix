<?php

class BackgroundPosition extends Eloquent{
	
	/**
	 * Parameters
	 */
	protected $table = 'background_positions';


	/**
	 * Relations
	 *
	 * @var string
	 */
    public function background()
    {
    	return $this->hasMany('Background');
	}
}