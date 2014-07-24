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

    public function responsivesByPriority(){
    	$countR = count($this->responsives);
    	
    	if(count($this->responsives) == 1){
    		return $this->responsives;
    	}else{
    		$datas = array($this->responsives);
    		for( $i = 0 ; $i < $countR ; $i++ ){

    		}
    	}

    	
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