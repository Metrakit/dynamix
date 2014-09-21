<?php

class Page extends Eloquent {

	/**
	 * Parameters
	 */
	protected $table = 'pages';


	/**
	 * Relations
	 *
	 * @var string
	 */
	public function blocks() {
        return $this->hasMany('Block')->orderBy('order','ASC');
    }


	/**
	 * Polymorphic relation
	 *
	 * @var string
	 */
	public function structure() {
        return $this->morphMany('Structure', 'structurable');
    }

    public function navigation() {
        return $this->morphMany('Nav', 'naviggable');
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


	/**
     * Attributes
     *
     * @return mixed
     */
	public function name() {
		return $this->i18n_name;
	}

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


}