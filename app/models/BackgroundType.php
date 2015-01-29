<?php

class BackgroundType extends Eloquent{
	
	/**
	 * Parameters
	 */
	protected $table = 'background_types';


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