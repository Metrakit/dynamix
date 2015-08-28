<?php

namespace Dynamix\Models;

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
	public function parts() 
	{
        return $this->hasMany('Dynamix\Models\Page', 'onepage_id')->orderBy('order','ASC');
    }


	/**
	 * Polymorphic relation
	 *
	 * @var string
	 */
	public function structure() 
	{
        return $this->morphMany('Dynamix\Models\Structure', 'structurable');
    }

    public function trackable() 
    {
        return $this->morphTo();
    }

	
	/**
	 * Additional Method
	 *
	 * @var string
	 */
	public static function getNavs() 
	{
		return 'todo';
	}
	public static function getClassName () 
	{
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
	public function title() 
	{
		return $this->structure->first()->title();
	}

	public function url() 
	{
		return $this->structure->first()->url();
	}

	public function meta_title() 
	{
		return $this->structure->first()->meta_title();
	}

	public function meta_description() 
	{
		return $this->structure->first()->meta_description();
	}


    //i18n
    public function onepage_title_locale( $locale_id ) 
    {
        return parent::getTranslation( $this->structure->first()->i18n_title , $locale_id );
    }
    public function onepage_url_locale( $locale_id ) 
    {
        return parent::getTranslation( $this->structure->first()->i18n_url , $locale_id );
    }
    public function onepage_meta_title_locale( $locale_id ) 
    {
        return parent::getTranslation( $this->structure->first()->i18n_meta_title , $locale_id );
    }
    public function onepage_meta_description_locale( $locale_id ) 
    {
        return parent::getTranslation( $this->structure->first()->i18n_meta_description , $locale_id );
    }
}