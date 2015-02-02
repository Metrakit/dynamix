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
		try{
			$data['ga_sessionsPerDay'] 			= App::make('GoogleAnalyticsAPIController')->getSessionsPerDay();
			$data['ga_sessionsCount'] 			= App::make('GoogleAnalyticsAPIController')->getSessionsCount();
			$data['ga_userCount'] 				= App::make('GoogleAnalyticsAPIController')->getUserCount();
			$data['ga_pageSeenCount'] 			= App::make('GoogleAnalyticsAPIController')->getPageSeenCount();
			$data['ga_pagesBySession'] 			= round( $data['ga_pageSeenCount'] / $data['ga_sessionsCount'], 2);
			$data['ga_timeBySession'] 			= round( App::make('GoogleAnalyticsAPIController')->getTimeBySession() / $data['ga_sessionsCount'], 0).'s';
			$data['ga_rebound'] 				= App::make('GoogleAnalyticsAPIController')->getRebound();
			$data['ga_newOnReturningVisitor'] 	= App::make('GoogleAnalyticsAPIController')->getNewOnReturningVisitor();
			$data['ga_googleAnalyticsFound'] = true;
		}catch(Exception $e){
			Log::error('Google Analytics API not found');
			$data['ga_googleAnalyticsFound'] = false;
		}
		$data = array_merge($data,App::make('AdminTasksController')->generateShow());
		if (Request::ajax()) {
			return Response::json(View::make( 'admin.index', $data )->renderSections());
		} else {
			return View::make('admin.index', $data );
		}
	}


	/**
	 * get the Filemanager
	 *
	 * @return Response
	 */
	public function getMedia()
	{
		//User
		$data['user'] = Auth::user();

		//Interface
		$data['noAriane'] = true;

		if (Request::ajax()) {
			return Response::json(View::make( 'admin.media.index', $data )->renderSections());
		} else {
			return View::make('admin.media.index', $data);
		}
	}



	/**
	 * get All User in base
	 *
	 * @return Response
	 */
/*	public function getMosaiques()
	{
		$mosaiques = Mosaique::all();

		return View::make('admin.mosaique.index', compact('mosaiques'));
	}*/


	/**
	 * get the Filemanager
	 *
	 * @return Response
	 */
	public function getRolePermission()
	{
		//User
		$data['user'] = Auth::user();

		//Roles
		$data['roles'] = Role::orderBy('name','ASC')->get();

		//Interface
		$data['noAriane'] = true;

		if (Request::ajax()) {
			return Response::json(View::make( 'admin.role_permission.index', $data )->renderSections());
		} else {
			return View::make('admin.role_permission.index', $data);
		}
	}

	/**
	 * get the Filemanager
	 *
	 * @return Response
	 */
	public function postPermission()
	{
		$role = Role::find( Input::get('role_id') );

		if ( !empty($role) ) {
			// Validate the inputs
	        $validator = Validator::make(Input::all(), Config::get('validator.admin.permission'));
	        
	        // Check if the form validates with success
	        if ($validator->passes()) {
	        	//[id] => name
	        	$resources = Cachr::getCache('DB_AdminResourceName');

	        	//Set allowed resources
	        	foreach ( Input::except(array('role_id','_token')) as $resource_id ) {
	        		//['resource_id'] => [id]
	        		Log::info('allowed resource : '.$resource_id);
	        		unset($resources[$resource_id]);
	        			$permission = Permission::where('role_id','=',$role->id)->where('resource_id','=',$resource_id)->first();
	        			if ( !empty($permission) ) {
	        				$permission->type = 'allow';
	        				if ( !$permission->save() ) {
								return Redirect::to('admin/role_permission')->with( 'error_permissions', Lang::get('admin.permission_save_error') );
	        				}
	        			}
	        		
	        	}

	        	//Set deny resources
	        	foreach ( $resources as $k => $resource ) {
	        		$permissions = Permission::where('role_id','=',$role->id)->where('resource_id','=',$k)->get();
	        		Log::info('denied resource : '.$k);

	        		foreach ( $permissions as $permission ) {	        			
		        		if ( !empty($permission) ) {
	        				$permission->type = 'deny';
	        				if ( !$permission->save() ) {
								return Redirect::to('admin/role_permission')->with( 'error_permissions', Lang::get('admin.permission_save_error') );
	        				}
	        			}
	        		}
	        	}
	        	
	        	//track user
	        	parent::track('update','Permission', $role->id);

				return Redirect::to('admin/role_permission')->with('success_permissions', Lang::get('admin.permission_save_success'));
	        }
		
			return Redirect::to('/admin/role_permission')->withInput()->withErrors($validator);
		}

		return Redirect::to('/admin/role_permission')->with('error_permissions', Lang::get('admin.role_not_found'));
	
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

		if (Request::ajax()) {
			return Response::json(View::make( 'admin.environment.index', $data )->renderSections());
		} else {
			return View::make('admin.environment.index', $data);
		}
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
        	foreach ( $activeLang as $lang ) {
        		if ( !array_search($lang->id, Input::all()) ){
        			//Si on trouve rien
        			foreach ( $activeLang as $lang ) {
		        		if ( !array_search($lang->id, Input::all()) ){
		        			//Si on trouve rien
		        			foreach ( Translation::where('locale_id','=',$lang->id)->get() as $translation ) {
		        				if (!$translation->delete() ) {
									return Redirect::to('/admin/environment')->with('error', Lang::get('admin.translate_delete_error'));
		        				}
		        			}
		        			//set locale disabled
		        			$locale = Locale::find($lang->id);
		        			$locale->enable = false;
		        			$locale->save();

		        			//track user
		        			parent::track('delete','Locale',$locale->id);
		        		}
		        	}
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
				//track user
				parent::track('create','Locale', $locale->id);
        	}

			return Redirect::to('/admin/environment')->with('success', Lang::get('admin.language_success'));
	    }
	    
		// Show the page
		return Redirect::to('/admin/environment')->withInput()->withErrors($validator);
	}


	/**
	 * get All Option in base
	 *
	 * @return Response
	 */
	public function getLog()
	{
		//User
		$data['user'] = Auth::user();

		//Interface
		$data['noAriane'] = true;

		$data['logs'] = Track::orderBy('date','DESC')->paginate(20);

		if (Request::ajax()) {
			return Response::json(View::make( 'admin.log.index', $data )->renderSections());
		} else {
			return View::make('admin.log.index', $data);
		}
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

		if (Request::ajax()) {
			return Response::json(View::make( 'admin.option.index', $data )->renderSections());
		} else {
			return View::make('admin.option.index', $data);
		}
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

        		//track user
        		parent::track('update','Option',null);  

          		return Redirect::to('admin/option')->with( 'success', Lang::get('admin.option_success') );

        	} else {
	        	return Redirect::to('admin/option')->with( 'error', Lang::get('admin.option_error') );
	        }
	    }
	    
		// Show the page
		return Redirect::to('/admin/option')->withInput()->withErrors($validator);
	}

	public function getI18nConstant () {
		//User
		$data['user'] = Auth::user();

		//Interface
		$data['noAriane'] = true;

		$data['i18nConstants'] = Option::first();

		if (Request::ajax()) {
			return Response::json(View::make( 'admin.option.index', $data )->renderSections());
		} else {
			return View::make('admin.option.index', $data);
		}
	}
	public function postI18nConstant () {

	}
}