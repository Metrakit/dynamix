<?php

class Block extends Eloquent{
	
	/**
	 * Parameters
	 */
	protected $table = 'blocks';


	/**
	 * Relations
	 *
	 * @var string
	 */
	public function page() {
        return $this->hasOne('Page');
    }

	public function responsives() {
        return $this->hasMany('Responsive');
    }

    public function responsivesByPriority()
    {
    	return $this->responsives()
    		->join('responsive_triggers','block_responsive.responsive_trigger_id','=','responsive_triggers.id')
    		->join('responsive_widths','block_responsive.responsive_width_id','=','responsive_widths.id')
    		->orderBy('responsive_triggers.priority','ASC');
	}


	/**
	 * Polymorphic relation
	 *
	 * @var string
	 */
	public function blockable()
    {
        return $this->morphTo();
    }
    public function trackable()
    {
        return $this->morphTo();
    }



    /**
     * Attributes
     *
     * @return mixed
     */
}