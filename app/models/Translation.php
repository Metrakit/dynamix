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

    /**
     * A translation has one locale
     *
     * @return mixed
     */
    public function urls() {
        $i18n_type_id = I18nType::whereCached('name','=','url')->first()->id;

        
        return $this->hasOne('Locale');
    }


}