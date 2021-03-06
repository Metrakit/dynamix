<?php

class Option extends Eloquent
{
	/**
	 * Parameters
	 */
	protected $table = 'options';
	protected $primaryKey = "id";
	public static $langNav = 'admin.nav_option';
	public $timestamps = false;


	/**
	 * Polymorphic Relation
	 *
	 * @var string
	 */
	public function trackable()
    {
        return $this->morphTo();
    }


    /**
     * Get an option
     * @param  string $key
     * @return string
     */
	public static function get($key)
	{
		return Config::get('option.' . $key);
	}

	/**
     * Set an option
     * @param  string $key, string $value
     * @return boolean
     */
	public static function set($key,$value) 
	{
		if (self::has($key)) {

			$option = Option::where('key','=',$key)->first();
			if (!empty($option)) {

				$option->value = $value;
				if ($option->save()) {

					Cache::forget('options');
					return true;
				} 
			}
		}
		return false;
	}

	/**
	 * Check if the option exist
	 * @param  string  $key
	 * @return boolean
	 */
	public static function has($key)
	{
		return Config::has('option.' . $key);
	}	

	/**
	 * Additional Method
	 *
	 * @var string
	 */
	public static function translate($key, $locale_id = null)
	{
		$i18n_id = Config::get('option.i18n_' . $key);
		if ($locale_id === null) {
			$locale_id  = App::getLocale();
		}

		return I18n::getTranslation($i18n_id, $locale_id);
	}


	/**
     * Attributes
     *
     * @return mixed
     */
	public function site_name_locale($locale_id)
	{
		return self::translate('site_name', $locale_id);
	}
	public function site_name()
	{
		return self::translate('site_name');
	}
	public function social_title_locale($locale_id)
	{
		return self::translate('social_title', $locale_id);
	}
	public function social_title()
	{
		return self::translate('social_title');
	}
	public function social_description_locale($locale_id)
	{
		return self::translate('social_description', $locale_id);
	}
	public function social_description()
	{
		return self::translate('social_description');
	}


}