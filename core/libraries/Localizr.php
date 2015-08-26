<?php

/**
 * Localizr - Detection of locale
 * @version 1.0
 * @author David LEPAUX <d.lepaux@gmail.com>
 */

class Localizr
{
	//get the locale id in url, if exist is it setted else default locale is setted
	public static function initLocale () {
		$segmentOne = Request::segment(1);
		$db_is_ok = false;
		try {
			$db_is_ok = DB::connection();
		} catch (Exception $e) {
			//Log::info($e);
		}

		/*Log::info('=================');
		Log::info('===== DEBUG =====');
		Log::info('=================');
		Log::info('');
		Log::info('//Variables states');
		Log::info('  Config::get(\'app.locale\') : ' . Config::get('app.locale'));
		Log::info('       Session::get(\'lang\') : ' . Session::get('lang'));
		Log::info('             Request::url() : ' . Request::url());
		Log::info('           App::getLocale() : ' . App::getLocale());
		Log::info('      Locale::countEnable() : ' . Locale::countEnable());
		Log::info('                $segmentOne : ' . $segmentOne);
		Log::info('================= END START');*/

		if ($db_is_ok) {
			if (Schema::hasTable('locales')) {
				// If only one lang is enable we dont need to set a Locale
				if (Locale::countEnable() <= 1) return null;

				//Test if segmentOne isnt in enabledLocale (because the first segment is not an enable locale, the locale is deductably the default)
				if(!in_array($segmentOne, Locale::getFrontEnabled())){					
					// Only for root
					if (Request::is('/') ) {
						$segmentOne = Config::get('app.locale_default');
						Session::put('lang',$segmentOne);
						App::setLocale($segmentOne);
						return null;
					}
					
					// For return visit
					if ( Session::has('lang') ) {
						// If locale in Session is same as Default (see up comment to know) Reset auto to default (return null)
						if (Session::get('lang') != Config::get('app.locale_default')) {
							Session::put('lang', Config::get('app.locale_default'));
							App::setLocale(Config::get('app.locale_default'));
							return null;
						}
						$segmentOne = Session::get('lang');
					} else {
						//if not, search a lang in server datas and if is valid
						$browser_lang = mb_substr(Request::server('HTTP_ACCEPT_LANGUAGE'), 0, 2);
					    // Check the browser request langugae is support in app?
					    if(!empty($browser_lang) AND in_array($browser_lang, Locale::getFrontEnabled()))
					    {
					        $segmentOne = $browser_lang;
					    }
					    else
					    {
					        // Default Application Setting Language
					        $segmentOne = Config::get('app.locale');
					    }	
						//if no valid lang is in server set default
						if($segmentOne===null) {
							Session::put('lang',Config::get('app.locale'));
						}
					}
				}



				if ( in_array($segmentOne, Locale::getFrontEnabled()) && $segmentOne != Session::get('lang') && Session::get('old_RequestSegment2') == Request::segment(2)) {
					//if it's a manual changement of locale_id in segment 1
					if ( Request::segment(2) == '' && Session::get('old_RequestSegment2') == '' ) {
						Session::put('lang', $segmentOne);
					} else {
						Log::info('put translate_request');
						Session::put('translate_request',1);
					}
				}
				Session::put('lang', $segmentOne);
				App::setLocale($segmentOne);
			} else {
				$segmentOne = null;
			}
		} else {
			$segmentOne = null;
		}

		//Test if locale is the default locale of app
		if (Config::get('app.locale_default') == $segmentOne) {
			Session::put('lang', $segmentOne);
			App::setLocale($segmentOne);
			return null;
		}

		/*Log::info('=================');
		Log::info('===== DEBUG =====');
		Log::info('=================');
		Log::info('');
		Log::info('//Variables states');
		Log::info('  Config::get(\'app.locale\') : ' . Config::get('app.locale'));
		Log::info('       Session::get(\'lang\') : ' . Session::get('lang'));
		Log::info('             Request::url() : ' . Request::url());
		Log::info('           App::getLocale() : ' . App::getLocale());
		Log::info('      Locale::countEnable() : ' . Locale::countEnable());
		Log::info('                $segmentOne : ' . $segmentOne);
		Log::info('================= END END');*/

		return $segmentOne;
	}


	// Get locale with an URL sensitive
	public static function getURLLocale ($locale = null) {
		if ($locale===null) $locale = App::getLocale();
		return (Config::get('app.locale_default') == $locale?'':$locale);
	}
}