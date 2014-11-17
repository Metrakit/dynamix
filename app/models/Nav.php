<?php

class Nav extends Eloquent{

	/**
	 * Parameters
	 */
	protected $table = 'navigations';
	public $timestamps = false;


	/**
	 * Relation
	 *
	 * @var string
	 */
	public function resource() {
        return $this->hasOne('Resource');
    }


    /**
	 * Polymorphic relation
	 *
	 * @var string
	 */
	public function navigable()
	{
        return $this->morphTo();
    }
	
	
	/**
	 * Additional method
	 *
	 * @var string
	 */
	public function i18n () {
 		return I18n::find($this->i18n_title);
 	}

 	public function translateLocale( $i18n_id, $locale_id ) {
		return Translation::where('i18n_id','=',$i18n_id)->where('locale_id','=', $locale_id)->first()->text;
	}

	public function navigation_title_locale( $locale_id ) {
		return $this->translateLocale( $this->i18n_title, $locale_id );
	}

	public function children() {
        return Nav::where('parent_id','=',$this->id)->orderBy('order','ASC')->get();
    }

	public function title() {
		return $this->translate( $this->i18n_title );
	}

	public function trackable() {
        return $this->morphTo();
    }

    public function hasResource () {
    	if ( $this->navigable ) {
    		return $this->navigable;
    	}
    	return false;
    }

	public function isMaxOrder() {
		//If menu is a child AND get maxOrder siblings
		if($this->parent_id != 0){
			$maxOrder = Nav::where('parent_id','=',$this->parent_id)->where('id','<>',$this->id)->max('order');
		}else{
			$maxOrder = Nav::where('parent_id','=',0)->where('id','<>',$this->id)->max('order');
		}
		if(empty($maxOrder)) return true;//there are only one menu or one child
		if($this->order > $maxOrder ) return true;
		return false;
    }

    public static function max() {
		return DB::table('navigations')->where('parent_id','=',0)->max('order');
    }

    

	/**
	 * Additional Method
	 *
	 * @var string
	 */
	public function translate( $i18n_id ){
		return Translation::where('i18n_id','=',$i18n_id)->where('locale_id','=',App::getLocale())->first()->text;
	}

	public function url(){
		return ( $this->navigable_type !=  'NavLink' ? App::getLocale() : '') . $this->navigable->url();
	}
}