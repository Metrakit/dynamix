<?php

class AdminNavigationController extends BaseController {

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

		//Main menu
		$data['navs'] 					= Nav::where('parent_id','=',0)->orderBy('order','ASC')->get();

		//allowable resource
		$data['resource_not_allowed']	= parent::getResourceNotAllowed();

		return View::make('admin.navigation.index', $data );
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function createChoose()
	{
		//User
		$data['user'] = Auth::user();

		//Interface
		$data['noAriane'] 		= true;

		//allowable resource
		$data['resource_not_allowed']	= parent::getResourceNotAllowed();

		// load the create form (app/views/nerds/create.blade.php)
		return View::make('admin.navigation.create-choose', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//User
		$data['user'] = Auth::user();

		//Interface
		$data['noAriane'] 		= true;
		$data['buttonLabel'] 	= Lang::get('button.add');
		$data['glyphicon'] 		= 'plus';

		//Datas
		$data['isChildren']					= false;
		$data['order']						= Input::get('order');
		if( Input::has('parent_id') ) {//If parent_id is present and set, this is a child
			$data['isChildren']					= true;
			$data['parent_id']					= Input::get('parent_id');
		}

		//allowable resource
		$data['resource_not_allowed']	= parent::getResourceNotAllowed();

		// load the create form (app/views/nerds/create.blade.php)
		return View::make('admin.navigation.create', $data);
	}

	/**
	 * Store all type of menu, parent, child internal or external link and button
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules = array();
		$navigation_title_datas = array();
		foreach ( Input::except('_token') as $k => $v ) {
			if ( strpos($k, 'navigation_title_') !== false ) {
				$rules[$k] = Config::get('validator.admin.navigation_title.title');
				$navigation_title_datas[substr( $k, strlen('navigation_title_'), (strlen($k) - strpos($k, 'navigation_title_')))] = $v;
			}
		}

		$rules = array_merge( $rules, Config::get('validator.admin.navigation'));
		//return var_dump($rules);
		// Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

		if ( $validator->passes() ) {

			//create i18n key
			$i18n_title = new I18n();
			$i18n_title->i18n_type_id = I18nType::where('name', '=', 'navigation')->first()->id;
			$i18n_title->save();
			foreach ( $navigation_title_datas as $locale => $value) {
				if( !$i18n_title->translate($locale, $value) ) return Redirect::to('admin/navigation')->with('error', Lang::get('admin.navigation_save_fail'));
			}

			$navigation = new Nav();
            $navigation->i18n_title    		= $i18n_title->id;

            if (Input::has('parent_id')) {
            	$navigation->parent_id = Input::get('parent_id');
            } else {
            	$navigation->parent_id = 0;
            }

            if (Input::has('url_external')) {
            	//create a link and put the id in the navigable_id :)
            	$nav_link = new NavLink();
            	$nav_link->url = Input::get('url_external');
            	$nav_link->save();

            	$navigation->navigable_id = $nav_link->id;
            	$navigation->navigable_type = 'NavLink';
            }

            if (Input::has('order')) {
            	$navigation->order = Input::get('order');
            } else {
				$navigation->order = Nav::max() + 1;
            }

            if (Input::has('model_resource_id')) {
            	$result_explode = explode('|', Input::get('model_resource_id'));
            	$navigation->navigable_id = $result_explode[1];
            	$navigation->navigable_type = $result_explode[0];
            }

            // Was the blog post created?
            if($navigation->save())
            {
            	//track user
                $track = new Track();
                $track->user_id = Auth::user()->id;
                $track->date = new Datetime;
                $track->action = 'create';
                $track->trackable_id = $navigation->id;
                $track->trackable_type = 'Navigation';
                $track->save();

            	Cache::forget('DB_Nav');
                // Redirect to the new blog post menu
                return Redirect::to('admin/navigation')->with('success','Le menu à bien été ajouté !');
            }

            // Redirect to the blog post create menu
            return Redirect::to('admin/navigation/create')->with('error', 'Le menu n\'a pas pu être enregistrée...');
        }

        // Form validation failed
        return Redirect::to('admin/navigation/create')->withInput()->withErrors($validator);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//User
		$data['user'] = Auth::user();

		//Interface
		$data['noAriane'] 		= true;
		$data['buttonLabel'] 	= Lang::get('button.update');
		$data['glyphicon'] 		= 'ok';

		//Datas
		$data['navigation'] = Nav::find($id);
		if (empty($data['navigation'])) return Redirect::to('admin/navigation')->with('error', Lang::get('admin.navigation_notfind'));

		if ($data['navigation']->navigable_type == 'NavLink') {
			$data['link_external'] = true;
		}

		if ($data['navigation']->navigable_type != null && $data['navigation']->navigable_type != 'NavLink') {
			$data['link_internal'] = true;
			$data['current_resource_id'] 	= $data['navigation']->navigable_id;
			$data['current_resource_type'] 	= $data['navigation']->navigable_type;
		}
		

		//allowable resource
		$data['resource_not_allowed']	= parent::getResourceNotAllowed();

		// show the edit form and pass the nerd
		return View::make('admin.navigation.edit', $data);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$navigation = Nav::find($id);

		if (empty($navigation)) return Redirect::to('admin/navigation')->with('success', Lang::get('admin.navigation_notfind'));

		$rules = array();
		$navigation_name_locales = array();
		foreach ( Input::except('_token') as $k => $v ) {
			if ( strpos($k, 'navigation_title_') !== false ) {
				$rules[$k] = Config::get('validator.admin.navigation_title.title');
				$navigation_name_locales[] = substr( $k, strlen('navigation_title_'), (strlen($k) - strpos($k, 'navigation_title_')));
			}
		}

		$rules = array_merge( $rules, Config::get('validator.admin.navigation'));
		//return var_dump($rules);
		// Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

		if ( $validator->passes() ) {

			//Update translations
        	foreach ( $navigation_name_locales as $locale ) {
        		if ( !I18n::find($navigation->i18n_title)->updateText($locale, Input::get('navigation_title_'.$locale)) ) {
        			return Redirect::to('admin/navigation')->with('error', Lang::get('admin.navigation_update_error'));
        		}
        	}

			/*           
			if (Input::has('parent_id')) {
            	$navigation->parent_id = Input::get('parent_id');
            } else {
            	$navigation->parent_id = 0;
            }
            */

            if (Input::has('url_external')) {
            	//create a link and put the id in the navigable_id :)
            	$nav_link = NavLink::find($navigation->navigable_id);
            	$nav_link->url = Input::get('url_external');
            	$nav_link->save();
            }

            if (Input::has('order')) {
            	$navigation->order = Input::get('order');
            } else {
				$navigation->order = Nav::max() + 1;
            }

            if (Input::has('model_resource_id')) {
            	$result_explode = explode('|', Input::get('model_resource_id'));
            	$navigation->navigable_id = $result_explode[1];
            	$navigation->navigable_type = $result_explode[0];
            }

            // Was the blog post created?
            if($navigation->save())
            {
            	//track user
                $track = new Track();
                $track->user_id = Auth::user()->id;
                $track->date = new Datetime;
                $track->action = 'update';
                $track->trackable_id = $id;
                $track->trackable_type = 'Navigation';
                $track->save();

            	Cache::forget('DB_Nav');
                // Redirect to the new blog post menu
                return Redirect::to('admin/navigation')->with('success','Le menu à bien été ajouté !');
            }

            // Redirect to the blog post create menu
            return Redirect::to('admin/navigation/create')->with('error', 'Le menu n\'a pas pu être enregistrée...');
        }

        // Form validation failed
        return Redirect::to('admin/navigation/create')->withInput()->withErrors($validator);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		// delete
		$navigation = Nav::find($id);

		if (empty($navigation)) return Redirect::to('admin/navigation')->with('success', Lang::get('admin.navigation_notfind'));

		//delete all translation
		foreach ( $navigation->i18n()->translations() as $translation ) {
			if (!$translation->delete()) return Redirect::to('admin/navigation')->with('error', Lang::get('admin.navigation_translation_delete_fail'));
		}

		// delete
		if ( $navigation->delete() ) {
			//track user
			$track = new Track();
			$track->user_id = Auth::user()->id;
			$track->date = new Datetime;
			$track->action = 'delete';
			$track->trackable_id = $navigation->id;
			$track->trackable_type = 'Navigation';
			$track->save();

			Cache::forget('DB_Nav');
                
			return Redirect::to('admin/navigation')->with('success', Lang::get('admin.navigation_delete_success'));
		}
		
		return Redirect::to('admin/navigation')->with('success', Lang::get('admin.navigation_delete_fail'));
	}
	


	/**
	 * Move the specified resource in order
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function move($id)
	{
		// find resource
		$menu = Menu::find($id);

		if( !empty($menu) ){
			//identify the direction
			$direction = Input::get('direction');

			switch ($direction) {
				case 'up':
					$menuUpper = Menu::where('parent_id','=',$menu->parent_id)->where('order','=',$menu->order - 1)->first();
					$menuUpper->order = $menu->order;
					$menu->order = $menu->order - 1;
					if( $menu->save() && $menuUpper->save() ){
						Cache::forget('DB_Menu');
						return Redirect::to('admin/menu')->with('success','L\'opération s\'est excécuté avec succès !');
					}
					break;
				case 'right':
					$menuRighter = Menu::where('parent_id','=',0)->where('order','=',$menu->order + 1)->first();
					$menuRighter->order = $menu->order;
					$menu->order = $menu->order + 1;
					if( $menu->save() && $menuRighter->save() ){
						Cache::forget('DB_Menu');
						return Redirect::to('admin/menu')->with('success','L\'opération s\'est excécuté avec succès !');
					}
					break;
				case 'down':
					$menuDowner = Menu::where('parent_id','=',$menu->parent_id)->where('order','=',$menu->order + 1)->first();
					$menuDowner->order = $menu->order;
					$menu->order = $menu->order + 1;
					if( $menu->save() && $menuDowner->save() ){
						Cache::forget('DB_Menu');
						return Redirect::to('admin/menu')->with('success','L\'opération s\'est excécuté avec succès !');
					}
					break;
				case 'left':
					$menuRighter = Menu::where('parent_id','=',0)->where('order','=',$menu->order - 1)->first();
					$menuRighter->order = $menu->order;
					$menu->order = $menu->order - 1;
					if( $menu->save() && $menuRighter->save() ){
						Cache::forget('DB_Menu');
						return Redirect::to('admin/menu')->with('success','L\'opération s\'est excécuté avec succès !');
					}
					break;
			}
			Cache::forget('DB_Menu');

			return Redirect::to('admin/menu')->with('error','Il y a eu un problème lors de l\'opération...');
		}

		return Redirect::to('admin/menu')->with('error','Menu introuvable !');
	}

}