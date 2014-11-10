<?php

class AdminTagController extends BaseController {
	
	/**
	 *Diisplay list of resources
	 *
	 * @return Response
	 */
	public function index()
	{
		//User
		$data['user'] 			= Auth::user();

		//Interface
		$data['noAriane'] 		= true;

		//Construction d'un tableau de 
		$data['langsFrontEnd'] = Locale::where('enable','=',1)->orderBy('enable', 'DESC')->orderBy('id')->get();
		
		return View::make('admin.tag.index', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//User
		$data['user'] 			= Auth::user();

		//Interface
		$data['noAriane'] 		= true;
		$data['buttonLabel'] 	= Lang::get('button.add');
		$data['glyphicon'] 		= 'plus';
		
		return View::make('admin.tag.create', $data);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $rules = array();
		$tag_name_datas = array();
		foreach ( Input::except('_token') as $k => $v ) {
			if ( strpos($k, 'tag_name_') !== false ) {
				$rules[$k] = Config::get('validator.admin.tag.name');
				$tag_name_datas[substr( $k, strlen('tag_name_'), (strlen($k) - strpos($k, 'tag_name_')))] = $v;
			}
		}
		//return var_dump($tag_name_datas);

		// Validate the inputs
        $validator = Validator::make(Input::except('_token'), $rules);

		if ( $validator->passes() ) {
			//create i18n key

			$i18n_name = new I18n();
			$i18n_name->i18n_type_id = I18nType::where('name', '=', 'tag')->first()->id;
			$i18n_name->save();
			foreach ( $tag_name_datas as $locale => $value) {
				if( !$i18n_name->translate($locale, $value) ) return Redirect::to('admin/tag')->with('error', Lang::get('admin.tag_save_fail'));
			}

			$tag = new Tag();
            $tag->i18n_name    		= $i18n_name->id;
           
            // Was the blog post created?
            if ( $tag->save() ) {
                //track user
				$track = new Track();
				$track->user_id = Auth::user()->id;
				$track->date = new Datetime;
				$track->action = 'create';
				$track->trackable_id = $tag->id;
				$track->trackable_type = 'Tag';
				$track->save();
                
                return Redirect::to('admin/tag')->with('success', Lang::get('admin.tag_save_success'));
            }

            // Redirect to the blog post create tag
            return Redirect::to('admin/tag/create')->with('error', Lang::get('admin.tag_save_fail'));
        }

        // Form validation failed
        return Redirect::to('admin/tag/create')->withInput()->withErrors($validator);
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
		$data['user'] 			= Auth::user();

		//Interface
		$data['noAriane'] 		= true;
		$data['buttonLabel'] 	= Lang::get('button.update');
		$data['glyphicon'] 		= 'ok';

	    $data['tag'] = Tag::find($id);
	    if(empty($data['tag'])) return Redirect::back()->with('error', Lang::get('admin.tag_empty') );

		return View::make('admin.tag.edit', $data);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$rules = array();
		$tag_name_locales = array();
		foreach ( Input::all() as $k => $v ) {
			if ( strpos($k, 'tag_name_') !== false ) {
				$rules[$k] = Config::get('validator.admin.option_site_name');
				$tag_name_locales[] = substr( $k, strlen('tag_name_'), (strlen($k) - strpos($k, 'tag_name_')));
			}
		}

		// Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

		$tag = Tag::find($id);
		if ( $validator->passes() ) {

            if ( !empty($tag) ) {
	        	//Update translations
	        	foreach ( $tag_name_locales as $locale ) {
	        		if ( !I18n::find($tag->i18n_name)->updateText($locale, Input::get('tag_name_'.$locale)) ) {
	        			return Redirect::to('admin/tag')->with('error', Lang::get('admin.tag_update_error'));
	        		}
	        	}
	           
                //track user
                $track = new Track();
                $track->user_id = Auth::user()->id;
                $track->date = new Datetime;
                $track->action = 'update';
                $track->trackable_id = $id;
                $track->trackable_type = 'Tag';
                $track->save();
            
                return Redirect::to('admin/tag')->with('success', Lang::get('admin.tag_edit_success'));
            }

            // Redirect to the blog post create tag
            return Redirect::to('admin/tag/' . $id . '/edit')->with('error', Lang::get('admin.tag_edit_fail'));
        }

        // Form validation failed
        return Redirect::to('admin/tag/' . $id . '/edit')->withInput()->withErrors($validator);
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy ($id) {
		//find resource
		$tag = Tag::find($id);

		//delete all translation
		foreach ( $tag->i18n()->translations() as $translation ) {
			if (!$translation->delete()) return Redirect::to('admin/tag')->with('error', Lang::get('admin.tag_translation_delete_fail'));
		}
		//delete all polymoprphic relation with Model
		foreach ( $tag->taggables() as $taggable ) {
			if (!$taggable->delete()) return Redirect::to('admin/tag')->with('error', Lang::get('admin.tag_translation_delete_fail'));
		}

		// delete
		if ( $tag->delete() ) {
			//track user
			$track = new Track();
			$track->user_id = Auth::user()->id;
			$track->date = new Datetime;
			$track->action = 'delete';
			$track->trackable_id = $tag->id;
			$track->trackable_type = 'Tag';
			$track->save();
                
			return Redirect::to('admin/tag')->with('success', Lang::get('admin.tag_delete_success'));;
		}
		
		return Redirect::to('admin/tag')->with('success', Lang::get('admin.tag_delete_fail'));;
	}
}