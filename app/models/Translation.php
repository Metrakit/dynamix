<?php

class Translation extends Eloquent{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'translations';
    public $timestamps = false;

	/**
     * A translation has one i18n
     *
     * @return mixed
     */
	public function i18n() {
        return $this->hasOne('I18n');
    }

    /**
     * A translation has one locale
     *
     * @return mixed
     */
    public function locale() {
        return $this->hasOne('Locale');
    }


}