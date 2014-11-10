<?php
/**
 * Localizr - 
 * @version 1.0
 * @author David LEPAUX <d.lepaux@gmail.com>
 */
class Localizr
{
	//get the locale id in url, if exist is it setted else default locale is setted
	public static function initLocale () {
		$locale = Request::segment(1);
		if(in_array($locale, Cachr::getCache('DB_LocaleFrontEnable'))){
			\App::setLocale($locale);
		}else{
			$locale = null;
		}
		return $locale;
	}
	//Detect locale from server
	public static function detectLocale () {
		// 1. get the request langugage
	    $url_lang = Request::segment(1);
	    Log::info('url_lang : '.$url_lang);
	    // 2. get Cookie langugage
	    $cookie_lang = Cookie::get('language');
	    // 3. Get the Browser Request language
	    $browser_lang = substr(Request::server('HTTP_ACCEPT_LANGUAGE'), 0, 2);
	    // 4. Start Checking the request language
	    // Check that Language tha request is support or not?
	    if(!empty($url_lang) AND in_array($url_lang, Cachr::getCache('DB_LocaleFrontEnable')))
	    {
	        // Check whether the request url lang not same as remember in cookies
	        if($url_lang != $cookie_lang)
	        {
	            Session::put('lang', $url_lang);
	        }
	        // Set the App Locale
	        App::setLocale($url_lang);
	    }
	    // Check that has Language in Forever Cookie and is it support or not?
	    else if(!empty($cookie_lang) AND in_array($cookie_lang, Cachr::getCache('DB_LocaleFrontEnable')))
	    {
	        // Set App Locale
	        App::setLocale($cookie_lang);
	    }
	    // Check the browser request langugae is support in app?
	    else if(!empty($browser_lang) AND in_array($browser_lang, Cachr::getCache('DB_LocaleFrontEnable')))
	    {
	        // Check whether the request url lang not same as remember in cookies
	        if($browser_lang != $cookie_lang)
	        {
	            Session::put('lang', $browser_lang);
	        }
	        // Set Browser Lang
	        App::setLocale($browser_lang);
	    }
	    else
	    {
	        // Default Application Setting Language
	        App::setLocale(Config::get('app.locale'));
	    }
	    if ( !Session::has('lang') ) Session::put('lang', App::getLocale());
	}
}