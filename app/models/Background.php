<?php

class Background extends Eloquent{
	
	/**
	 * Parameters
	 */
	protected $table = 'backgrounds';


	/**
	 * Relations
	 *
	 * @var string
	 */
	public function parts() {
        return $this->hasMany('Part');
    }

    public function background_type()
    {
    	return $this->hasOne('BackgroundType');
	}
}