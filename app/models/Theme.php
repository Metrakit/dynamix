<?php

class Theme extends Eloquent{

	/**
     * Parameters
     */
	protected $table = 'themes';
    public $timestamps = false;


    public static function getThemeName () {
		//Get themeType
		$themeType = "public";
		if ( Request::segment(1) == "admin" ) {
			$themeType = "admin";
		}

		$themes = self::where('active', 1)->get();

	    $data = array();
	    foreach( $themes as $theme ) {
	    	$data[$theme->type] = $theme->name;
	    }

		$themes = $data;

		//Get themeName
		return (isset($themes[$themeType])?$themes[$themeType]:'default');
    }
}