<?php

namespace Dynamix\Models;

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
    	return $this->hasMany('Dynamix\Models\Background');
	}
}