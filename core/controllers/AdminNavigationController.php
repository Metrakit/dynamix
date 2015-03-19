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

		if (Request::ajax()) {
			return Response::json(View::make('theme::' . 'admin.navigation.index', $data )->renderSections());
		} else {
			return View::make('theme::' .'admin.navigation.index', $data );
		}
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
		return View::make('theme::' .'admin.navigation.create-choose', $data);
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
		if ( Input::has('parent_id') ) {//If parent_id is present and set, this is a child
			$data['isChildren']					= true;
			$data['parent_id']					= Input::get('parent_id');
		}

		//allowable resource
		$data['resource_not_allowed']	= parent::getResourceNotAllowed();

		// load the create form (app/views/nerds/create.blade.php)
		return View::make('theme::' .'admin.navigation.create', $data);
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
				$navigation_title_datas[mb_substr( $k, strlen('navigation_title_'), (strlen($k) - strpos($k, 'navigation_title_')))] = $v;
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
				if ( !$i18n_title->translate($locale, $value) ) return Redirect::to('admin/navigation')->with('error', Lang::get('admin.navigation_save_fail'));
			}

			$navigation = new Nav();
            $navigation->i18n_title    		= $i18n_title->id;

            if (Input::has('parent_id')) {
            	$navigation->parent_id = Input::get('parent_id');
            } else {
            	$navigation->parent_id = 0;
            }

            //There case : external link, internal link and link container (button)
            if (Input::has('url_external')) {
            	//create a link and put the id in the navigable_id :)
            	$nav_link = new NavLink();
            	$nav_link->url = Input::get('url_external');
            	$nav_link->save();

            	$navigation->navigable_id = $nav_link->id;
            	$navigation->navigable_type = 'NavLink';
            }
            if (Input::has('model_resource_id')) {
            	$result_explode = explode('|', Input::get('model_resource_id'));
            	$navigation->navigable_id = $result_explode[1];
            	$navigation->navigable_type = $result_explode[0];
            }
            if (!Input::has('url_external')&&!Input::has('model_resource_id')) {
            	$nav_link = new NavLink();
            	$nav_link->url = '#';
            	$nav_link->save();

            	$navigation->navigable_id = $nav_link->id;
            	$navigation->navigable_type = 'NavLink';
            }

            if (Input::has('order')) {
            	$navigation->order = Input::get('order');
            } else {
				$navigation->order = Nav::max() + 1;
            }

            // Was the blog post created?
            if ($navigation->save())
            {
            	//track user
                parent::track('create','Navigation',$navigation->id);

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
		return View::make('theme::' .'admin.navigation.edit', $data);
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
				$navigation_name_locales[] = mb_substr( $k, strlen('navigation_title_'), (strlen($k) - strpos($k, 'navigation_title_')));
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
            if (Input::has('model_resource_id')) {
            	$result_explode = explode('|', Input::get('model_resource_id'));
            	$navigation->navigable_id = $result_explode[1];
            	$navigation->navigable_type = $result_explode[0];
            }

            if (Input::has('order')) {
            	$navigation->order = Input::get('order');
            } else {
				$navigation->order = Nav::max() + 1;
            }


            // Was the blog post created?
            if($navigation->save())
            {
            	//track user
                parent::track('update','Navigation',$navigation->id);

            	Cache::forget('DB_Nav');
                // Redirect to the new blog post menu
                return Redirect::to('admin/navigation')->with('success','Le menu à bien été modifié !');
            }

            // Redirect to the blog post edit menu
            return Redirect::to('admin/navigation/' . $id . '/edit')->with('error', 'Le menu n\'a pas pu être modifiée...');
        }

        // Form validation failed
        return Redirect::to('admin/navigation/' . $id . '/edit')->withInput()->withErrors($validator);
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
		$nav = Nav::find($id);

		if( !empty($nav) ){
			//identify the direction
			$direction = Input::get('direction');

			switch ($direction) {
			    case 'up':
					parent::track('update','Navigation', $nav->id);
			        return $this->moveNav($nav, 'up', -1, $nav->parent_id);
			        break;
			    case 'down':
			    	parent::track('update','Navigation', $nav->id);
			        return $this->moveNav($nav, 'down', 1, $nav->parent_id);
			        break;
				case 'right':
					parent::track('update','Navigation', $nav->id);
					return $this->moveNav($nav, 'right', 1, 0);
					break;
				case 'left':
					parent::track('update','Navigation', $nav->id);
					return $this->moveNav($nav, 'left', -1, 0);
					break;
			    default:
			       	return Redirect::to('admin/navigation')->with('error',Lang::get('admin.navigation_direction_not_set'));
			}

			Cache::forget('DB_Nav');
			return Redirect::to('admin/navigation')->with('error',Lang::get('admin.navigation_move_fail'));
		}
		return Redirect::to('admin/navigation')->with('error',Lang::get('admin.navigation_notfind'));
	}

	public function moveNav ($nav, $direction, $increment, $parent_id) {
		$old_order = $nav->order;
        $nav->order = $old_order + $increment;

        $nav_next = Nav::where('parent_id', $parent_id)->where('order', $old_order + $increment)->first();
        if (!empty($nav_next)){
	        $nav_next->order = $old_order;
	        $nav_next->save();
        } else {
        	return Redirect::to('admin/navigation')->with('error',Lang::get('admin.navigation_move_'. $direction .'_impossible'));
        }
        if ($nav->save()){
        	return Redirect::to('admin/navigation')->with('success',Lang::get('admin.navigation_move_successfully'));
        } else {
        	return Redirect::to('admin/navigation')->with('error',Lang::get('admin.navigation_move_'. $direction .'_save_error'));
        }
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

		//equilibrate branche
		//here equilibrate orders of menu !
		//if parentid = 0, set all else other !
		$navigations = Nav::where('parent_id',$navigation->parent_id)->where('id','<>',$navigation->id)->orderBy('order','ASC')->get();			
		for ($count_navigation = count($navigations), $i = 0;$i<$count_navigation;$i++) {
			$navigations[$i]->order = $i+1;
			$navigations[$i]->save();
		}

		//delete children if exists
		foreach ( $navigation->children() as $child ) {
			$child->delete();
		}

		// delete
		if ( $navigation->delete() ) {
			//track user
			parent::track('delete','Navigation', $navigation->id);

			Cache::forget('DB_Nav');

			return Redirect::to('admin/navigation')->with('success', Lang::get('admin.navigation_delete_success'));
		}
		
		return Redirect::to('admin/navigation')->with('success', Lang::get('admin.navigation_delete_fail'));
	}
}