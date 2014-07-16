<?php

class Locale extends Eloquent{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'locale';

	/**
     * A Locale has many i48n
     *
     * @return mixed
     */
	public function i18n() {
        return $this->hasMany('I18n');
    }
}