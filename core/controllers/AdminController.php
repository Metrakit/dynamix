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
	

	// Clear cache methods
	public function clearcache () {
		Cache::flush();
		return Redirect::back();
	}



}