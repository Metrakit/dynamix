<?php

namespace Dynamix\Models;

class BackgroundPosition extends Model {
	
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
    	return $this->hasMany('Dynamix\Models\Background');
	}
}