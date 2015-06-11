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

		//$data = array_merge($data,App::make('AdminTasksController')->generateShow());
		if (Request::ajax()) {
			return Response::json(View::make('theme::' . 'admin.index', $data )->renderSections());
		} else {
			return View::make('theme::' .'admin.index', $data );
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
			return Response::json(View::make('theme::' . 'admin.media.index', $data )->renderSections());
		} else {
			return View::make('theme::' .'admin.media.index', $data);
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

		return View::make('theme::' .'admin.mosaique.index', compact('mosaiques'));
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
			return Response::json(View::make('theme::' . 'admin.role_permission.index', $data )->renderSections());
		} else {
			return View::make('theme::' .'admin.role_permission.index', $data);
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
			return Response::json(View::make('theme::' . 'admin.environment.index', $data )->renderSections());
		} else {
			return View::make('theme::' .'admin.environment.index', $data);
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
			
			$activeLang = Locale::where('enable', 1)->get();

        	//Identify new languages
        	$newLang = array();
        	$langToPublish = array();
        	foreach ( Input::all() as $langKey => $langValue ) {
        		if (strpos($langKey, 'is_publish_') !== false) {
        			$langToPublish[] = substr($langKey, strlen('is_publish_'), strlen($langKey)-strlen('is_publish_'));
        		} else {    			
	        		if ( Translation::where('locale_id','=',$langKey)->count() == 0 ) {
	        			$newLang[] = Input::get($langKey);
	        		}
        		}
        	}
        	//var_dump($langToPublish);
        	//var_dump($newLang);


        	//Identify old languages
        	foreach ( $activeLang as $lang ) {
        		//Check if new lang
        		if ( !array_search($lang->id, Input::all()) ){
        			//Si on trouve rien
        			foreach ( Translation::where('locale_id','=',$lang->id)->get() as $translation ) {
        				if (!$translation->delete() ) {
							return Redirect::to('/admin/environment')->with('error', Lang::get('admin.translate_delete_error'));
        				}
        			}
        			//set locale disabled
        			$lang->enable = false;
        			$lang->is_publish = false;
        			$lang->save();

        			//track user
        			parent::track('delete','Locale',$lang->id);
        		} else {
        			//Ancienne langue détecté !, 
        			// CHeck is ispublish is true in db, and if not find in array(= must be unpublish)
        			//echo $lang->id;
        			//var_dump($langToPublish);
        			//echo $lang->id . '<br>';
        			//echo (in_array($lang->id, $langToPublish)?'1':'0');
        			if (!in_array($lang->id, $langToPublish)) {
        				$lang->is_publish = false;
        			} else {
        				$lang->is_publish = true;
        			}
        			$lang->save();
        		}
        	}
        	//die;

        	//get all i18n IDs to create all translation with the new locale ID
        	$i18ns = I18n::all();
        	//For each lang
        	foreach ( $newLang as $lang ) {
        		//Create each i18n ID
        		foreach ( $i18ns as $i18n ) {
        			$text = Translation::where('i18n_id','=',$i18n->id)->where('locale_id', Config::get('app.locale_default'))->first()->text;
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
				if (!array_search($locale->id, $langToPublish)) {
    				$locale->is_publish = false;
    			} else {
    				$locale->is_publish = true;    				
    			}

				if ( ! $locale->save() ) {
					return Redirect::to('/admin/environment')->with('error', Lang::get('admin.languauge_save_error'));
				}
				//track user
				parent::track('create','Locale', $locale->id);
        	}

        	//Publish or unpublish locale

        	Locale::countEnable(true);

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
			return Response::json(View::make('theme::' . 'admin.log.index', $data )->renderSections());
		} else {
			return View::make('theme::' .'admin.log.index', $data);
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

		$data['option'] = new Option;

		$data['options'] = Option::all();

		//Data for themes
		$data['theme_publics'] = Theme::where('type', 'public')->get();
		$data['theme_admins'] = Theme::where('type', 'admin')->get();

		if (Request::ajax()) {
			return Response::json(View::make('theme::' . 'admin.option.index', $data )->renderSections());
		} else {
			return View::make('theme::admin.option.index', $data);
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
				$site_name_locales[] = mb_substr( $k, strlen('site_name_'), (strlen($k) - strpos($k, 'site_name_')));
			}
		}

		//Making adaptive rules for social_title
		$social_title_rules = array();
		$social_title_locales = array();
		foreach ( Input::all() as $k => $v ) {
			if ( strpos($k, 'social_title_') !== false ) {
				$social_title_rules[$k] = Config::get('validator.admin.option_social_title');
				$social_title_locales[] = mb_substr( $k, strlen('social_title_'), (strlen($k) - strpos($k, 'social_title_')));
			}
		}

		//Making adaptive rules for social_description
		$social_description_rules = array();
		$social_description_locales = array();
		foreach ( Input::all() as $k => $v ) {
			if ( strpos($k, 'social_description_') !== false ) {
				$social_description_rules[$k] = Config::get('validator.admin.option_social_description');
				$social_description_locales[] = mb_substr( $k, strlen('social_description_'), (strlen($k) - strpos($k, 'social_description_')));
			}
		}

		$rules = array_merge( $site_name_rules, $social_title_locales, $social_description_locales, Config::get('validator.admin.option') );

		// Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        
        // Check if the form validates with success
        if ($validator->passes())
        {
        	//Themes
        	$activeThemePublic = Theme::where('type', 'public')->where('active', 1)->first();
        	$activeThemeAdmin = Theme::where('type', 'admin')->where('active', 1)->first();

        	//Change or not?
        	if ( $activeThemePublic->id != Input::get('theme_public')) {
        		$activeThemePublic->active = false;
        		$activeThemePublic->save();
        		$newThemePublic = Theme::find(Input::get('theme_public'));
        		$newThemePublic->active = true;
        		$newThemePublic->save();
        	}
			if ( $activeThemeAdmin->id != Input::get('theme_admin')) {
        		$activeThemeAdmin->active = false;
        		$activeThemeAdmin->save();
        		$newThemeAdmin = Theme::find(Input::get('theme_public'));
        		$newThemeAdmin->active = true;
        		$newThemeAdmin->save();
        	}
        	//Delete Cache
        	Cache::forget('DB_ThemeByType');


        	//Options
        	$options = Option::all();

        	foreach ($options as $option) {

        		if ($option->key == "site_url") {
        			$option->value		= Input::get('site_url');
        		}

        		if ($option->key == "cover_path") {
        			$option->value		= Input::get('cover_path');
        		}

        		if ($option->key == "admin_email") {
        			$option->value		= Input::get('admin_email');
        		}

        		if ($option->key == "analytics") {
        			$option->value		= Input::get('analytics');
        		}

        		if ($option->key == "i18n_site_name") {

		        	//Update translations
		        	foreach ( $site_name_locales as $locale ) {
		        		if ( !I18n::find($option->value)->updateText($locale, Input::get('site_name_'.$locale)) ) {
		        			return Redirect::to('admin/option')->with('error', Lang::get('admin.option_site_name_update_error'));
		        		}
		        	}
		        }

		        if ($option->key == "i18n_social_title") {

					//Update translations
		        	foreach ( $social_title_locales as $locale ) {
		        		if ( !I18n::find($option->value)->updateText($locale, Input::get('social_title_'.$locale)) ) {
		        			return Redirect::to('admin/option')->with('error', Lang::get('admin.option_social_title_update_error'));
		        		}
		        	}
		        }

	        	if ($option->key == "i18n_social_description") {

					//Update translations
		        	foreach ( $social_description_locales as $locale ) {
		        		if ( !I18n::find($option->value)->updateText($locale, Input::get('social_description_'.$locale)) ) {
		        			return Redirect::to('admin/option')->with('error', Lang::get('admin.option_social_description_update_error'));
		        		}
		        	}
		        }

        		$option->save();
        	}

        	// Clear cache
        	Cache::forget('options'); 

    		//track user
    		parent::track('update', 'Option', null);  

          	return Redirect::to('admin/option')->with( 'success', Lang::get('admin.option_success') );
	    }
	    
		// Show the page
		return Redirect::to('/admin/option')->withInput()->withErrors($validator);
	}

	/**
	 * get All Option in base
	 *
	 * @return Response
	 */
	public function getRerouter() {
		//User
		$data['user'] = Auth::user();

		//Interface
		$data['noAriane'] = true;

		$data['reroutes'] = Rerouter::all();

		if (Request::ajax()) {
			return Response::json(View::make('theme::' . 'admin.rerouter.index', $data )->renderSections());
		} else {
			return View::make('theme::' .'admin.rerouter.index', $data);
		}
	}

	/**
	 * post All Option in base
	 *
	 * @return Response
	 */
	public function storeRerouter() {
		// Validate the inputs
        $validator = Validator::make(Input::all(), Config::get('validator.admin.reroute'));

        // Check if the form validates with success
        if ($validator->passes())
        {
        	$reroute = new Rerouter;
        	$reroute->url_referer = Input::get('url_referer');
        	$reroute->url_redirect = Input::get('url_redirect');

        	//if no error when save
        	if($reroute->save()) {
        		Cache::forget('DB_Reroutes'); 
          		return Redirect::to('admin/rerouter')->with( 'success', Lang::get('admin.rerouter_store_success') );
        	} else {
	        	return Redirect::to('admin/rerouter')->with( 'error', Lang::get('admin.rerouter_store_error') );
	        }
	    }
	    
		// Show the page
		return Redirect::to('/admin/rerouter')->withInput()->withErrors($validator);
	}
	public function updateRerouter($id) {
		// Validate the inputs
        $validator = Validator::make(Input::all(), Config::get('validator.admin.reroute'));

        // Check if the form validates with success
        if ($validator->passes())
        {
        	$reroute = Rerouter::find($id);
        	if (empty($reroute)) return Redirect::to('admin/rerouter')->with( 'notice', Lang::get('admin.reroute_dont_exist') );
        	$reroute->url_referer = Input::get('url_referer');
        	$reroute->url_redirect = Input::get('url_redirect');

        	//if no error when save
        	if($reroute->save()) {
        		Cache::forget('DB_Reroutes'); 
          		return Redirect::to('admin/rerouter')->with( 'success', Lang::get('admin.rerouter_update_success') );
        	} else {
	        	return Redirect::to('admin/rerouter')->with( 'error', Lang::get('admin.rerouter_update_error') );
	        }
	    }
	    
		// Show the page
		return Redirect::to('/admin/rerouter')->withInput()->withErrors($validator);
	}
	public function destroyRerouter($id) {
		$reroute = Rerouter::find($id);
        if (empty($reroute)) return Redirect::to('admin/rerouter')->with( 'notice', Lang::get('admin.reroute_dont_exist') );

        if ($reroute->delete()) {
        	Cache::forget('DB_Reroutes');
        	return Redirect::to('admin/rerouter')->with( 'success', Lang::get('admin.rerouter_destroy_success') );
    	} else {
        	return Redirect::to('admin/rerouter')->with( 'error', Lang::get('admin.rerouter_destroy_error') );
        }
	}


	public function getI18nConstant () {
		//User
		$data['user'] = Auth::user();

		//Interface
		$data['noAriane'] = true;

		$data['i18nConstants'] = I18n::where('i18n_type_id', I18nType::where('name', 'key')->first()->id)->get();

		if (Request::ajax()) {
			return Response::json(View::make('theme::' . 'admin.i18n-constant.index', $data )->renderSections());
		} else {
			return View::make('theme::' .'admin.i18n-constant.index', $data);
		}
	}
	public function postI18nConstant () {
		//Récupération des inputs
		//key_[key]_[locale_id] = value

		$i18n_datas = array();

		//build i18n_data for update
		foreach( Input::all() as $name => $value ) {
			if (strpos($name, 'key_') !== false) {
				//subvision of 'key_'
				$name = mb_substr($name, 4, strlen($name)-4);

				//explode key and locale_id
				$data = explode("_", $name);
				$key = $data[0]; // piece1
				$locale_id = $data[1]; // piece2

				//put data in array i18n_datas				
				$i18n_datas[$key][$locale_id] = $value;
			}
		}

		//update i18ns
		foreach( $i18n_datas as $key => $value ) {
			$id = I18n::where('key', $key)->first()->id;
			I18n::change($id, $value);
		}

      	return Redirect::to('admin/i18n-constant')->with( 'success', Lang::get('admin.i18n_constant_success') );
	}
	

	// Clear cache methods
	public function clearcache () {
		Cache::flush();
		return Redirect::back();
	}



}