<?php

class Responsive extends Eloquent{
	
	/**
	 * Parameters
	 */
	protected $table = 'block_responsive';

	
	/**
	 * Relations
	 *
	 * @var string
	 */
	public function block() {
        return $this->hasOne('Block');
    }

	public function width() {
        return $this->belongsTo('Rwidth','responsive_width_id');
    }

	public function trigger() {
        return $this->belongsTo('Rtrigger','responsive_trigger_id');
    }


    /**
     * Attributes
     *
     * @return mixed
     */

}