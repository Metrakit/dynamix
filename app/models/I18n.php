<?php

class I18n extends Eloquent{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'i18n';
    public $timestamps = false;

	/**
     * An i48n has many translation
     *
     * @return mixed
     */
	public function translations() {
        return $this->hasMany('Translation');
    }

   	/**
     * An i48n has many urls
     *
     * @return mixed
     */
	public function urls() {
        return $this->hasMany('Urls');
    }




    
}