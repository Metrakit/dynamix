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
     * An i48n has one type
     *
     * @return mixed
     */
    public function types() {
        return $this->hasOne('I18nType');
    }


    /**
     * Method to translate some text with the locale_id
     * @param $locale_id
     * @param $text
     * @return bool
     */
	public function translate( $locale_id, $text ) {
        if( Translation::create( array('i18n_id' => $this->id, 'locale_id' => $locale_id, 'text' => $text ) ) ){
            return true;
        }
        return false;
    }
}