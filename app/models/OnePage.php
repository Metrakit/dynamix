<?php

class OnePage extends Eloquent {

	/**
	 * Table name
	 */
	protected $table = 'onepage';

	/**
	 * Relations
	 *
	 * @var string
	 */
	public function parts() {
        return $this->hasMany('Part', 'onepage_id')->orderBy('order','ASC');
    }


	/**
	 * Polymorphic relation
	 *
	 * @var string
	 */
	public function structure() {
        return $this->morphMany('Structure', 'structurable');
    }

    public function trackable() {
        return $this->morphTo();
    }

	
	/**
	 * Additional Method
	 *
	 * @var string
	 */
	public function translate( $i18n_id ) {
		return Translation::where('i18n_id','=',$i18n_id)->where('locale_id','=',App::getLocale())->first()->text;
	}

	public static function getClassName () {
		return get_class();
	}


	/**
     * Attributes
     *
     * @return mixed
     */


	/**
     * Herited attributes
     *
     * @return mixed
     */
	public function title() {
		return $this->structure->first()->title();
	}

	public function url() {
		return $this->structure->first()->url();
	}

	public function meta_title() {
		return $this->structure->first()->meta_title();
	}

	public function meta_description() {
		return $this->structure->first()->meta_description();
	}


    //i18n
    public function translateLocale( $i18n_id, $locale_id ) {
        return Translation::where('i18n_id','=',$i18n_id)->where('locale_id','=', $locale_id)->first()->text;
    }
    
    public function onepage_title_locale( $locale_id ) {
        return $this->translateLocale( $this->structure->first()->i18n_title , $locale_id );
    }
    public function onepage_url_locale( $locale_id ) {
        return $this->translateLocale( $this->structure->first()->i18n_url , $locale_id );
    }
    public function onepage_meta_title_locale( $locale_id ) {
        return $this->translateLocale( $this->structure->first()->i18n_meta_title , $locale_id );
    }
    public function onepage_meta_description_locale( $locale_id ) {
        return $this->translateLocale( $this->structure->first()->i18n_meta_description , $locale_id );
    }
}