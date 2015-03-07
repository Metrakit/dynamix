<?php

class Option extends Eloquent
{
	/**
	 * Parameters
	 */
	protected $table = 'options';
	protected $primaryKey = "id";
	public static $langNav = 'admin.nav_option';
	public $timestamps = false;


	/**
	 * Polymorphic Relation
	 *
	 * @var string
	 */
	public function trackable()
    {
        return $this->morphTo();
    }

	/**
	 * Additional Method
	 *
	 * @var string
	 */
	public function translate( $i18n_id )
	{
		return Translation::where('i18n_id','=',$i18n_id)->where('locale_id','=',App::getLocale())->first()->text;
	}

	public function translateLocale( $i18n_id, $locale_id )
	{
		return Translation::where('i18n_id','=',$i18n_id)->where('locale_id','=', $locale_id)->first()->text;
	}


	/**
     * Attributes
     *
     * @return mixed
     */
	public function site_name_locale( $locale_id )
	{
		return $this->translateLocale( $this->i18n_site_name, $locale_id );
	}

	public function site_name()
	{
		return $this->translate( $this->i18n_site_name );
	}

	public function social_title_locale( $locale_id )
	{
		return $this->translateLocale( $this->i18n_social_title, $locale_id );
	}

	public function social_title()
	{
		return $this->translate( $this->i18n_social_title );
	}

	public function social_description_locale( $locale_id )
	{
		return $this->translateLocale( $this->i18n_social_description, $locale_id );
	}

	public function social_description()
	{
		return $this->translate( $this->i18n_social_description );
	}


}