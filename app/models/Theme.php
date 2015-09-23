<?php

class Theme extends Eloquent{

	/**
     * Parameters
     */
	protected $table = 'themes';
    public $timestamps = false;


    public static function getThemeName () {
    	if (Schema::hasTable('themes')) {
			// Set themeType
			$themeType = "public";
			if ( Request::segment(1) == "admin" ) $themeType = "admin";

			// Get Theme name with type
			$themeName = self::getThemeByType($themeType);

			// Return themeName
			return $themeName;
		}
		return 'default';
    }

    public static function getThemeType () {
		$themeType = "public";
		// Set themeType
		if ( Request::segment(1) == "admin" ) $themeType = "admin";

		// Return themeType
		return $themeType;
    }

    public static function getThemeByType($type) {
    	$cacheKey = 'Theme:ByType:' . $type;
    	if (Cache::has($cacheKey)) {
    		return Cache::get($cacheKey);
    	}
    	$themes = self::where('active', 1)->get();
    	$data = array();
	    foreach( $themes as $theme ) {
	    	$data[$theme->type] = $theme->name;
	    }
	    $themeName = (isset($data[$type])?$data[$type]:'default');
	    Cache::put($cacheKey, $themeName, 480);
	    return $themeName;
    }
}