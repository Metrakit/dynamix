<?php

class Structure extends Eloquent {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'structures';
	public $timestamps = false;

	/**
	 * structurable polymorphic
	 *
	 * @var string
	 */
	public function structurable()
    {
        return $this->morphTo();
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
}