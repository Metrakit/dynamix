<?php

class Locale extends Eloquent{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'locales';
	public $timestamps = false;

	/**
     * A Locale has many i48n
     *
     * @return mixed
     */
	public function translations() {
        return $this->hasMany('Translation');
    }
}