<?php

class Nav extends Eloquent{

	/**
	 * Parameters
	 */
	protected $table = 'navigations';


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
	public function naviggable(){
        return $this->morphTo();
    }

	
	public function children() {
        return Nav::where('parent_id','=',$this->id)->orderBy('order','ASC')->get();
    }

	public function title(){
		return $this->translate( $this->i18n_title );
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
		return $this->naviggable->url();
	}
}