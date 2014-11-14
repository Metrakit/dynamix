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

            if (Input::has('url_external')) $navigation->url = Input::get('url_external');

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
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function postCreateMenu()
	{
		$validator = Validator::make(Input::all(), Config::get('validator.menu.create'));

		// process the login
		if ($validator->passes()) 
		{
			$re_id = Input::get('resource_id_n_element_id');
			$resource_id = substr($re_id,0,strpos($re_id,'|'));
			$element_id = substr($re_id,strpos($re_id,'|')+1,strlen($re_id)-strpos($re_id,'|'));

			$newMenu = new Menu();
			$newMenu->title       = Input::get('title');
			$newMenu->resource_id = $resource_id;
			$newMenu->element_id  = $element_id;
			$newMenu->parent_id   = Input::get('parent_id');

			//If order = 1, transform mod
			if(Input::get('order') == 1){
				$menuParent = Menu::find(Input::get('parent_id'));
				Log::info($menuParent->resource_id);

				//if main menu isnot a linkcontainer, we saved the link
				if($menuParent->resource_id != 4){					
					$menuSaved = new Menu();
					$menuSaved->title       = $menuParent->title;
					$menuSaved->resource_id = $menuParent->resource_id;
					$menuSaved->element_id  = $menuParent->element_id;
					$menuSaved->parent_id   = Input::get('parent_id');
					$menuSaved->order       = Input::get('order');
					$menuSaved->url   		= $menuParent->url;
					
			        $menuSaved->save();
					
					$newMenu->order       = Input::get('order') + 1;
				}

				$menuParent->resource_id = 4;
				$menuParent->element_id = null;
				$menuParent->url = '#';
				//Transform the main menu
				$menuParent->save();

				$newMenu->order       = Input::get('order');
			}else{
				$newMenu->order       = Input::get('order');
			}
			

			//get the resource index with the i18n ID of the url
	        $data = array();
	        switch ( $resource_id ) {
	            case 1://Page
	                $newMenu->url = Page::find($element_id)->url;
	                break;
	            case 2://Mosaique
	                $newMenu->url = Mosaique::find($element_id)->url;
	                break;
	        	case 3://Gallery
	                $newMenu->url = Gallery::find($element_id)->url;
	                break;
	        }

            // Was the blog post created?
            if($newMenu->save())
            {
            	Cache::forget('DB_Menu');
                // Redirect to the new blog post menu
                return Redirect::to('admin/menu')->with('success','Le sous menu à bien été ajouté !');
            }

            // Redirect to the blog post create menu
            return Redirect::to('admin/menu/create-new-menu')->with('error', 'Le sous menu n\'a pas pu être enregistrée...');
        }

        // Form validation failed
        $data = array();
        $data['order'] = Input::get('order');
		$data['parent_id'] = Input::get('parent_id');
        return Redirect::to('admin/menu/create-new-menu',$data)->withInput()->withErrors($validator);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		// get the nerd
		$menu = Menu::find($id);

		$page_not_allowed			= parent::getNotAllowedPage();
		$mosaique_not_allowed		= parent::getNotAllowedMosaique();
		$gallery_not_allowed		= parent::getNotAllowedGallery();

		if($menu->resource_id != 4){
			switch ( $menu->resource_id ) {
	            case 1://Page
	                $page_not_allowed[] = Page::find( $menu->element_id );
	                break;
	            case 2://mosaique
	                $mosaique_not_allowed[] = Mosaique::find( $menu->element_id );
	                break;
	        	case 3://galley
	                $gallery_not_allowed[] = Gallery::find( $menu->element_id );
	                break;
	        }
		}			

		// show the edit form and pass the nerd
		return View::make('admin.menu.edit', compact('menu','page_not_allowed','mosaique_not_allowed','gallery_not_allowed'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$validator = Validator::make(Input::all(), Config::get('validator.menu.edit'));

		// process the login
		if ($validator->passes()) 
		{
			$menu = Menu::find($id);
			$menu->title       = Input::get('title');


            // Was the blog post created?
            if($menu->save())
            {
            	Cache::forget('DB_Menu');
                // Redirect to the new blog post menu
                return Redirect::to('admin/menu')->with('success','La menu à bien été mise à jour !');
            }

            // Redirect to the blog post create menu
            return Redirect::to('admin/menu/' . $id . '/edit')->with('error', 'La menu n\'a pas pu être enregistrée...');
        }

        // Form validation failed
        return Redirect::to('admin/menu/' . $id . '/edit')->withInput()->withErrors($validator);
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
		$menu = Menu::find($id);
		$menu->deleteWithChildren();

		Cache::forget('DB_Menu');

		// redirect
		Session::flash('success', 'Le menu à bien été supprmé !');
		return Redirect::to('admin/menu');
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