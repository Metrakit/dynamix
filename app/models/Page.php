<?php

class Page extends Eloquent {

	/**
	 * Parameters
	 */
	protected $table = 'pages';

	public static function formParams()
    {
        return array(        
            'type'  => 'horizontal',
            'title' => Lang::get('form.page.title'),
            'description' => Lang::get('form.page.description'),
            'data'  => array(
                'title' => array(
                    'name'        => 'title',
                    'type'        => 'text',
                    'rules'       => 'required',
                    'viewPath'        => 'public.form.input.text',
                    'title'       => Lang::get('input.page.title.title'),
                    'placeholder' => Lang::get('input.page.title.placeholder'),
                    'helper'      => Lang::get('input.page.title.helper'),
                    'label'       => Lang::get('input.page.title.label'),
                ),
                'description' => array(
                    'name'        => 'description',
                    'type'        => 'textarea',
                    'rules'       => 'required',
                    'viewPath'    => 'public.form.input.textarea',
                    'title'       => Lang::get('input.page.description.title'),
                    'placeholder' => Lang::get('input.page.description.placeholder'),
                    'helper'      => Lang::get('input.page.description.helper'),
                    'label'       => Lang::get('input.page.description.label'),
                ),
                'type' => array(
                    'name'        => 'type',
                    'type'        => 'select',
                    'rules'       => 'required',
                    'viewPath'        => 'public.form.input.select',
                    'options'     => array(
                        array(
                            'key'   => Lang::get('input.page.type.key.1'),
                            'value' => Lang::get('input.page.type.key.3'),
                        ),
                        array(
                            'key'   => Lang::get('input.page.type.value.2'),
                            'value' => Lang::get('input.page.type.value.3'),
                        ), 
                        array(
                            'key'   => Lang::get('input.page.type.value.3'),
                            'value' => Lang::get('input.page.type.value.3'),
                        ),                       
                    ),
                    'title'       => Lang::get('input.page.description.title'),
                    'placeholder' => Lang::get('input.page.description.placeholder'),
                    'helper'      => Lang::get('input.page.description.helper'),
                    'label'       => Lang::get('input.page.description.label'),
                ),
                'envoyer' => array(
                    'name'        => 'envoyer',
                    'type'        => 'submit',
                    'rules'       => 'required',
                    'viewPath'        => 'public.form.input.submit',
                    'title'       => Lang::get('input.page.description.title'),
                    'placeholder' => Lang::get('input.page.description.placeholder'),
                    'helper'      => Lang::get('input.page.description.helper'),
                    'label'       => Lang::get('input.page.description.label'),
                ),
            ),
            'method' => 'model',
        );
    }

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

    public function tags()
    {
        return $this->morphToMany('Tag', 'taggable');
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


}