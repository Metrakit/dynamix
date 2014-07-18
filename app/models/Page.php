<?php

class Page extends Eloquent {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'pages';

	
    /**
     * A Page has one structure
     *
     * @return mixed
     */
	public function structure() {
        return $this->belongsToMany('Structure');
    }

	/**
     * A Page has one structure
     *
     * @return mixed
     */
	public function maps() {
        return $this->hasMany('PageMap');
    }


	public function i18n_name()
	{
		return Translation::where('i18n_id','=',$this->i18n_name)
						  ->where('locale_id','=',App::getLocale())
						  ->first()
						  ->text;
	}

	public function i18n_title()
	{
		return Translation::where('i18n_id','=',$this->i18n_title)
						  ->where('locale_id','=',App::getLocale())
						  ->first()
						  ->text;
	}

	public function i18n_url()
	{
		return Urls::where('i18n_id','=',$this->i18n_url)
						  ->where('locale_id','=',App::getLocale())
						  ->first()
						  ->text;
	}

	public function i18n_content()
	{
		return Translation::where('i18n_id','=',$this->i18n_content)
						  ->where('locale_id','=',App::getLocale())
						  ->first()
						  ->text;
	}

	public function i18n_meta_title()
	{
		return Translation::where('i18n_id','=',$this->i18n_meta_title)
						  ->where('locale_id','=',App::getLocale())
						  ->first()
						  ->text;
	}

	public function i18n_meta_description()
	{
		return Translation::where('i18n_id','=',$this->i18n_meta_description)
						  ->where('locale_id','=',App::getLocale())
						  ->first()
						  ->text;
	}

	public function i18n_meta_keywords()
	{
		return Translation::where('i18n_id','=',$this->i18n_meta_keywords)
						  ->where('locale_id','=',App::getLocale())
						  ->first()
						  ->text;
	}


}