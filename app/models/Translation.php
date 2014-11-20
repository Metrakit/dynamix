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

    /**
     * Add a new translation of a Text
     * @param integer $i18nId i18n Id
     * @param string $lang lang code
     * @param string $value text translated
     * @return self 
     */
    public static function add($i18nId, $lang, $value)
    {
        $translation = new self;
        $translation->i18n_id = $i18nId;
        $translation->locale_id = $lang;
        $translation->text = $value;
        $translation->save();
        return $translation;
    }

    /**
     * Get texts translated by i18n Id
     * @param  integer $i18nId i18n id
     * @return Array
     */
    public static function getByI18n($i18nId)
    {
        $translations = self::where('i18n_id', $i18nId)
                   ->get();

        $texts = array();           
        foreach ($translations as $translation) {
            $texts[$translation->locale_id] = $translation->text;
        }
        return $texts;
    }

    /**
     * Update a new translation of a Text
     * @param integer $i18nId i18n Id
     * @param string $lang lang code
     * @param string $value text translated
     * @return self 
     */
    public static function change($i18nId, $lang, $value)
    {
        $translation = self::where('i18n_id', $i18nId)
                           ->where('locale_id', $lang)
                           ->first();

        if (!$translation) {
            return FALSE;
        }

        $translation->text = $value;
        $translation->save();
        return $translation;
    }   

    /**
     * Delete translation of a Text
     * @param integer $i18nId i18n Id
     * @return boolean 
     */
    public static function removeFromI18n($i18nId)
    {
        return self::where('i18n_id', $i18nId)->delete();
    }


}