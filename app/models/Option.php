<?php

class Option extends Eloquent
{
	/**
	 * Parameters
	 */
	protected $table = 'options';


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


	/**
     * Attributes
     *
     * @return mixed
     */
	public function site_name()
	{
		return $this->translate( $this->i18n_site_name );
	}


}