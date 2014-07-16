<?php

class Option extends Eloquent
{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'options';

	public function i18n_site_name()
	{
		return Translation::where('i18n_id','=',$this->i18n_site_name)->where('locale_id','=',App::getLocale())->first()->text;
	}
}