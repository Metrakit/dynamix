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
     * Attributes
     *
     * @return mixed
     */

	/**
	 * Additional Method
	 *
	 * @var string
	 */
	public function translate( $i18n_id )
	{
		return Translation::where('i18n_id','=',$i18n_id)->where('locale_id','=',App::getLocale())->first()->text;
	}
}