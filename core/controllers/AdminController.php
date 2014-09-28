<?php

class AdminController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//User
		$data['user'] = Auth::user();

		//Interface
		$data['noAriane'] = true;

		//Check if the connection is ok

		//Google Analytics
		$data['ga_sessionsPerDay'] 			= App::make('GoogleAnalyticsAPIController')->getSessionsPerDay();
		$data['ga_sessionsCount'] 			= App::make('GoogleAnalyticsAPIController')->getSessionsCount();
		$data['ga_userCount'] 				= App::make('GoogleAnalyticsAPIController')->getUserCount();
		$data['ga_pageSeenCount'] 			= App::make('GoogleAnalyticsAPIController')->getPageSeenCount();
		$data['ga_pagesBySession'] 			= round( $data['ga_pageSeenCount'] / $data['ga_sessionsCount'], 2);
		$data['ga_timeBySession'] 			= round( App::make('GoogleAnalyticsAPIController')->getTimeBySession() / $data['ga_sessionsCount'], 0).'s';
		$data['ga_rebound'] 				= App::make('GoogleAnalyticsAPIController')->getRebound();
		$data['ga_newOnReturningVisitor'] 	= App::make('GoogleAnalyticsAPIController')->getNewOnReturningVisitor();

		return View::make('admin.index', $data );
	}

	/**
	 * get All User in base
	 *
	 * @return Response
	 */
	public function getUser()
	{
		$users = User::all();

		return View::make('admin.user.index', compact('users'));
	}

	/**
	 * get All User in base
	 *
	 * @return Response
	 */
	public function getMosaiques()
	{
		$mosaiques = Mosaique::all();

		return View::make('admin.mosaique.index', compact('mosaiques'));
	}


	/**
	 * get the Filemanager
	 *
	 * @return Response
	 */
	public function getMedia()
	{
		//User
		$user = Auth::user();
		//Interface
		$noAriane = true;

		return View::make('admin.media.index', compact('user','noAriane'));
	}


	/**
	 * get All Option in base
	 *
	 * @return Response
	 */
	public function getOption()
	{
		//User
		$data['user'] = Auth::user();

		//Interface
		$data['noAriane'] = true;

		$data['option'] = Option::first();

		return View::make('admin.option.index', $data);
	}

	/**
	 * post All Option in base
	 *
	 * @return Response
	 */
	public function postOption()
	{
		//Making adaptive rules for site_name
		$site_name_rules = array();
		$site_name_locales = array();
		foreach ( Input::all() as $k => $v ) {
			if ( strpos($k, 'site_name_') !== false ) {
				$site_name_rules[$k] = Config::get('validator.admin.option_site_name');
				$site_name_locales[] = substr( $k, strlen('site_name_'), (strlen($k) - strpos($k, 'site_name_')));
			}
		}

		$rules = array_merge( $site_name_rules, Config::get('validator.admin.option') );

		// Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        
        // Check if the form validates with success
        if ($validator->passes())
        {
        	$option = Option::first();

        	$option->site_url		= Input::get('site_url');
        	$option->admin_email	= Input::get('admin_email');
        	$option->analytics		= Input::get('analytics');
        	
        	//Update translations
        	foreach ( $site_name_locales as $locale ) {
        		if ( !I18n::find($option->i18n_site_name)->updateText($locale, Input::get('site_name_'.$locale)) ) {
        			return Redirect::to('admin/option')->with('error', Lang::get('admin.option_site_name_update_error'));
        		}
        	}

        	//if no error when save
        	if($option->save()) {
        		Cache::forget('DB_Option');        		
            	return Redirect::to('admin/option')->with( 'success', Lang::get('admin.option_success') );
        	} else {
	        	return Redirect::to('admin/option')->with( 'error', Lang::get('admin.option_error') );
	        }
	    }
	    
		// Show the page
		return Redirect::to('/admin/option')->withInput()->withErrors($validator);
	}


	/**
	 * get All Option in base
	 *
	 * @return Response
	 */
	public function getEnvironnement()
	{
		//User
		$data['user'] = Auth::user();

		//Interface
		$data['noAriane'] = true;

		//Datas
		$data['langsFrontEnd'] = Locale::orderBy('enable', 'DESC')->orderBy('id')->get();
		$data['langsFrontEnd'] = array_chunk($data['langsFrontEnd']->toArray(), round(count($data['langsFrontEnd']->toArray())/3+1));
		//return var_dump($data['langsFrontEnd']);

		return View::make('admin.environment.index', $data);
	}

	/**
	 * post All Option in base
	 *
	 * @return Response
	 */
	public function postLanguages()
	{
		// Validate the inputs
        $validator = Validator::make(Input::all(), Config::get('validator.admin.languages'));

        // Check if the form validates with success
        if ($validator->passes()) {
			
			$activeLang = Locale::where('enable','=',1)->get();

        	//Identify new languages
        	$newLang = array();
        	foreach ( Input::all() as $lang ) {
        		if ( Translation::where('locale_id','=',$lang)->count() == 0 ) {
        			$newLang[] = $lang;
        		}
        	}

        	//Identify old languages
			$oldLang = array();
        	foreach ( $activeLang as $lang ) {
        		if( !array_search($lang->id, Input::all()) ){
        			//Si on trouve rien
        			$oldLang[] = $lang->id;
        		}
        	}

        	//get all i18n IDs to create all translation with the new locale ID
        	$i18ns = I18n::all();
        	//For each lang
        	foreach ( $newLang as $lang ) {
        		//Create each i18n ID
        		foreach ( $i18ns as $i18n ) {
        			$text = Translation::where('i18n_id','=',$i18n->id)->where('locale_id','en')->first()->text;
        			//Si on trouve pas de traduction
        			if ( Translation::where('i18n_id','=',$i18n->id)->where('locale_id','=',$lang)->first() === null ) {
        				//On la crée
	        			if ( !Translation::create( array('i18n_id' => $i18n->id, 'locale_id' => $lang, 'text' => $text . '-' . $lang) ) ) {
	        				return Redirect::to('/admin/environment')->with('error', Lang::get('admin.translate_create_error'));
	        			}
        			}
        		}
				$locale = Locale::find( $lang );
				$locale->enable = 1;
				if ( ! $locale->save() ) {
					return Redirect::to('/admin/environment')->with('error', Lang::get('admin.languauge_save_error'));
				}
        	}

			return Redirect::to('/admin/environment')->with('success', Lang::get('admin.language_success'));
	    }
	    
		// Show the page
		return Redirect::to('/admin/environment')->withInput()->withErrors($validator);
	}
}