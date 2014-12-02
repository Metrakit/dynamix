<?php

//use Symfony\Component\HttpFoundation\File\UploadedFile;

class AdminPageController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//User
		$data['user'] 			= Auth::user();

		//Interface
		$data['noAriane'] 		= true;
        $data['pages'] 			= Page::all();

		return View::make('admin.page.index', $data);
	}

	/**
	 * Show the form for create a resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//User
		$data['user'] 			= Auth::user();

		//Interface
		$data['action'] 		= 'create';
		$data['noAriane'] 		= true;

		return View::make('admin.page.form', $data);
	}

	/**
	 * Store the new resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$inputs = Input::all();
		$inputs['url'] = '/'.Str::slug($inputs['url']);

		//return var_dump($inputs);

        $validator = Validator::make($inputs, Config::get('validator.page.deletable'));
		
        // Check if the form validates with success
        if ($validator->passes())
        {
			$page = new Page();
            $page->title     		= $inputs['title'];
            $page->url 				= $inputs['url'];
            $page->content          = $inputs['content'];

            $page->meta_title       = $inputs['meta_title'];
            $page->meta_description = $inputs['meta_description'];

            $page->created_at    	= new DateTime();
            $page->updated_at    	= new DateTime();

            // Was the blog post created?
            if($page->save())
            {
            	Cache::forget('DB_Urls');
                // Redirect to the new blog post page
                return Redirect::to('admin/page')->with('success','La page à bien été créée !');
            }

            // Redirect to the blog post create page
            return Redirect::to('admin/page/create')->with('error', 'La page n\'a pas pu être enregistrée...');
        }

        // Form validation failed
        return Redirect::to('admin/page/create')->withInput()->withErrors($validator);
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

		// get the post
		$data['page'] = Page::find($id);

		if(empty($data['page'])){
			return Redirect::back()->with('error', 'Cette page est introuvable !');
		}

		return View::make('admin.page.edit', $data );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$page = Page::find($id);

		if(empty($page)){
			return Redirect::to('admin/page')->with('error','Cette page est introuvable !');
		}

		// Validate the inputs
		$validator = null;
		if(!$page->is_deletable){
        	$validator = Validator::make(Input::all(), Config::get('validator.page.no-deletable'));
		}else{			
        	$validator = Validator::make(Input::all(), Config::get('validator.page.deletable'));
		}
		
        // Check if the form validates with success
        if ($validator->passes())
        {
            // Update the page data
            $page->title            = Input::get('title');
            // If is not index
            if($page->url != '/'){
            	$url = Str::slug(Input::get('url'));
            	$page->url          = '/'.$url;
        	}
            $page->content          = Input::get('content');

            $page->meta_title       = Input::get('meta_title');
            $page->meta_description = Input::get('meta_description');

            $page->updated_at    	= new DateTime();

            // Was the blog post created?
            if($page->save())
            {
            	Cache::forget('DB_Urls');
                // Redirect to the new blog post page
                return Redirect::to('admin/page')->with('success','La page à bien été mise à jour !');
            }

            // Redirect to the blog post create page
            return Redirect::to('admin/page/' . $id . '/edit')->with('error', 'La page n\'a pas pu être enregistrée...');
        }

        // Form validation failed
        return Redirect::to('admin/page/' . $id . '/edit')->withInput()->withErrors($validator);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$success = 'La page a bien été supprimée !';
		// delete
		$page = Page::find($id);
		if(empty($page)){
			return Redirect::to('admin/page')->with('error', 'Cette page est introuvable !');
		}

		//Protect index
		if(!$page->is_deletable){
			return Redirect::to('admin/page')->with('notice', 'Cette page ne peut être supprimée !');
		}

		//Used in menu?
		$id = Menu::where('resource_id','=',Resource::where('name','=','page')->first()->id)->where('element_id','=',$page->id)->first();
		if(!empty($id)){
			$success = 'La page ainsi que le menu associé ont été supprimé avec succès !';
			App::make('AdminMenuController')->destroy($id->id);
		}

		Cache::forget('DB_Urls');
		
		
		$page->delete();

		// redirect
		return Redirect::to('admin/page')->with('success', $success);
	}
}