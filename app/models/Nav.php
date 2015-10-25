<?php

class Nav extends Eloquent{

	/**
	 * Parameters
	 */
	protected $table = 'navigations';
	public $timestamps = false;
	public static $langNav = 'admin.nav_navigation';


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

	public function children() {
        return Nav::where('parent_id','=',$this->id)->orderBy('order','ASC')->get();
    }

	public function title() {
		return Eloquentizr::getTranslation( $this->i18n_title );
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
	public function url(){
		return ( $this->navigable_type !=  'NavLink' && Locale::countEnable() > 1 ? Localizr::getURLLocale() : '') . $this->navigable->url();
	}

	public static function getNavigations () {
		return self::where('parent_id','=',0)->orderBy('order','ASC')->get();
	}

	public function deleteI18nAndMe () {
		$this->delete();
		if (!I18n::remove($this->i18n_title)) return false;
		return true;
	}
}