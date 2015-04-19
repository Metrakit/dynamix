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
		$db_is_ok = false;
		try {
			$db_is_ok = DB::connection();
		} catch (Exception $e) {
			Log::info($e);
		}
		
		//Log::info('Config::get(\'app.locale\') : ' . Config::get('app.locale'));
		if ($db_is_ok) {
			if (Schema::hasTable('locales')){
				
				// If only one lang is enable we dont need to set a Locale
				if (Locale::countEnable() <= 1) {
					Log::info('$locale choose for this load : null - Locale::countEnable() <= 1');
					return null;
				}

				//Test if segment 1 isnt here, and if is valid
				if(!in_array($locale, Cachr::getCache('DB_LocaleFrontEnable'))){					
					if (Request::is('/') ) {
						/*if (Session::has('lang')) {
							if (Config::get('app.locale_default') != Session::get('lang')) {
								$locale = Session::get('lang');
							} else {
								$locale = Config::get('app.locale_default');
							}
						} else {*/
						$locale = Config::get('app.locale_default');
						//}
						//Log::info('Config::get(\'app.locale_default\') : '.Config::get('app.locale_default'));
						//Log::info('$locale : '.$locale);
						//Log::info('Session::get(\'lang\') : '.Session::get('lang'));
						Session::put('lang',$locale);
						App::setLocale($locale);
						//Log::info('$locale choose for this load : Request::is(\'/\')');
						return null;
					} 
					if ( Session::has('lang') ) {//For return visit
						$locale = Session::get('lang');
					} else {
						//if not, search a lang in server datas and if is valid
						$browser_lang = mb_substr(Request::server('HTTP_ACCEPT_LANGUAGE'), 0, 2);
					    // Check the browser request langugae is support in app?
					    if(!empty($browser_lang) AND in_array($browser_lang, Cachr::getCache('DB_LocaleFrontEnable')))
					    {
					        $locale = $browser_lang;
					    }
					    else
					    {
					        // Default Application Setting Language
					        $locale = Config::get('app.locale');
					    }	
						//if no valid lang is in server set default
						if($locale===null) {
							Session::put('lang',Config::get('app.locale'));
						}
					}
				}
				Log::info('Session::get(\'old_RequestSegment2\')   :'.Session::get('old_RequestSegment2'));
				Log::info('Request::segment(2)                     :'.Request::segment(2));



				if ( in_array($locale, Cachr::getCache('DB_LocaleFrontEnable')) && $locale != Session::get('lang') && Session::get('old_RequestSegment2') == Request::segment(2)) {
					//if it's a manual changement of locale_id in segment 1
					if ( Request::segment(2) == '' && Session::get('old_RequestSegment2') == '' ) {
						Session::put('lang', $locale);
					} else {
						Log::info('put translate_request');
						Session::put('translate_request',1);
					}
				}
				Session::put('lang', $locale);
				App::setLocale($locale);
			} else {
				$locale = null;
			}
		} else {
			$locale = null;
		}

		//Test if locale is the default locale of app
		if (Config::get('app.locale_default') == $locale) {
			Session::put('lang', $locale);
			App::setLocale($locale);
			Log::info('$locale : ' . $locale);
			Log::info('$locale choose for this load : null - Config::get(\'app.locale\') == $locale');
			return null;
		}
		Log::info('$locale choose for this load : '. $locale);

		return $locale;
	}


	// Get locale with an URL sensitive
	public static function getURLLocale ($locale = null) {
		if ($locale===null) $locale = App::getLocale();
		return (Config::get('app.locale_default') == $locale?'':$locale);
	}
}