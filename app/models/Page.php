<?php

class Page extends Eloquent {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'pages';

	/**
	 * Polymorphic relation
	 *
	 * @var string
	 */
	public function structure()
    {
        return $this->morphMany('Structure', 'structurable');
    }

	/**
     * A Page has may block
     *
     * @return mixed
     */
	public function blocks() {
        return $this->hasMany('Block');
    }

	public function getBlocks()
	{
		return 'text';
	}
	

	/**
     * Attributes
     *
     * @return mixed
     */
	public function name()
	{
		return $this->i18n_name;
	}

	/**
     * Herited attributes
     *
     * @return mixed
     */
	public function title()
	{
		return $this->structure->first()->i18n_title;
	}

	public function url()
	{
		return $this->structure->first()->i18n_url;
	}

	public function meta_title()
	{
		return $this->structure->first()->i18n_meta_title;
	}

	public function meta_description()
	{
		return $this->structure->first()->i18n_meta_description;
	}


}