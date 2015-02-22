<?php

class Structure extends Eloquent {
	
	/**
	 * Parameters
	 */
	protected $table = 'structures';
	public $timestamps = false;


	/**
	 * Polymorphic relation
	 *
	 * @var string
	 */
	public function structurable()
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

	public function deleteI18nAndMe()
	{
		$this->delete();
		if (!I18n::remove($this->i18n_title)
		|| !I18n::remove($this->i18n_url)
		|| !I18n::remove($this->i18n_meta_title)
		|| !I18n::remove($this->i18n_meta_description)) return false;
		return true;
	}


	/**
	 * Attributes
	 *
	 * @var string
	 */
	public function title()
	{
		return $this->translate( $this->i18n_title );
	}

	public function url()
	{
		return $this->translate( $this->i18n_url );
	}

	public function meta_title()
	{
		return $this->translate( $this->i18n_meta_title );
	}

	public function meta_description()
	{
		return $this->translate( $this->i18n_meta_description );
	}
}