<?php

class Urls extends Eloquent{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'urls';
    public $timestamps = false;

   	/**
     * An Url has one i18n
     *
     * @return mixed
     */
	public function i18n() {
        return $this->hasOne('I18n');
    }

    /**
     * An Url has one locale
     *
     * @return mixed
     */
    public function locale() {
        return $this->hasOne('Locale');
    }

}