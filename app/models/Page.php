<?php

class Page extends Eloquent {

	/**
	 * Table name
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
        return $this->morphMany('Nav', 'navigable');
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

	public function isDeletable() {
		return $this->deletable;
	}

	public static function getNotAllowed () {
		$notAllowed = array();

		//get all Nav with a page as resource
		$navs = Nav::where('navigable_type','=',get_class())->get();
		$allowed = array();
		foreach ( $navs as $nav ) {
			$allowed[] = $nav->navigable->id;
		}

		//get all Pages
		$pages = Page::all();

		//store each resources
		foreach ( $pages as  $page ) {
			if ( !in_array( $page->id, $allowed ) ) {
				$notAllowed[] = $page;
			}
		}

		return $notAllowed;
	}

	public static function getClassName () {
		return get_class();
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


    //i18n
    public function translateLocale( $i18n_id, $locale_id ) {
        return Translation::where('i18n_id','=',$i18n_id)->where('locale_id','=', $locale_id)->first()->text;
    }
    
    public function page_title_locale( $locale_id ) {
        return $this->translateLocale( $this->structure->first()->i18n_title , $locale_id );
    }
    public function page_url_locale( $locale_id ) {
        return $this->translateLocale( $this->structure->first()->i18n_url , $locale_id );
    }
    public function page_meta_title_locale( $locale_id ) {
        return $this->translateLocale( $this->structure->first()->i18n_meta_title , $locale_id );
    }
    public function page_meta_description_locale( $locale_id ) {
        return $this->translateLocale( $this->structure->first()->i18n_meta_description , $locale_id );
    }


    //To surrcharge for comment module
    public function comments () {
    	return $this->morphMany('Comment', 'commentable');
    }

}