<?php

class Translation extends Eloquent{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'translations';
    public $timestamps = false;
    protected $fillable = ['i18n_id', 'locale_id', 'text'];

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
     * Additional Method
     *
     * @var string
     */
    public static function exec( $i18n_id )
    {
        return static::where('i18n_id', '=', $i18n_id)->where('locale_id', '=', App::getLocale())->first()->text;
    }

}