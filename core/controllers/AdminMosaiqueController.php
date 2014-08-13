<?php

class AdminMosaiqueController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$mosaiques = Mosaique::all();

		return View::make('admin.mosaique.index', compact('mosaiques'));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
	    $mosaique = Mosaique::find($id);
	    if(empty($mosaique)) return Redirect::back()->with('error', 'Cette page est introuvable !');

		return View::make('admin.mosaique.edit', compact('mosaique'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$mosaique = Mosaique::find($id);
		$inputs = Input::all();
		$inputs['url'] = '/'.Str::slug(Input::get('url'));

		if(empty($mosaique)){
			return Redirect::to('admin/mosaique')->with('error','Cette mosaique est introuvable !');
		}

		// Validate the inputs
        $validator = Validator::make($inputs, Config::get('validator.mosaique'));
        
        // Check if the form validates with success
        if ($validator->passes())
        {
            // Update the mosaique data
            $mosaique->title            = Input::get('title');

            //Check url
            if($mosaique->url != $inputs['url']){
            	//check is url is'nt exists
            	$pages_url = Page::where('url','=',$inputs['url'])->get();
            	$mosaiques_url = Mosaique::where('id','<>',$id)->where('url','=',$inputs['url'])->get();
            	$galleries_url = Gallery::where('url','=',$inputs['url'])->get();
            	if(count($pages_url) != 0 || count($galleries_url) != 0 || count($mosaiques_url) != 0){
            		return Redirect::to('admin/mosaique/'.$id.'/edit')->with('error','L\'url est déjà prise...');
            	}
            }
			$mosaique->url 					= $inputs['url'];
            $mosaique->description          = Input::get('description');

            $mosaique->meta_title       = Input::get('meta_title');
            $mosaique->meta_description = Input::get('meta_description');

            $mosaique->updated_at    	= new DateTime();

            // Was the blog post created?
            if($mosaique->save())
            {
            	Cache::forget('DB_Urls');
            	Cache::forget('DB_Mosaique');
                // Redirect to the new blog post mosaique
                return Redirect::to('admin/mosaique')->with('success','La mosaique à bien été mise à jour !');
            }

            // Redirect to the blog post create mosaique
            return Redirect::to('admin/mosaique/' . $id . '/edit')->with('error', 'La mosaique n\'a pas pu être enregistrée...');
        }
	    
		// Show the mosaique
		return Redirect::to('/admin/mosaique/'.$mosaique->id.'/edit')->withInput()->withErrors($validator);
	}
}