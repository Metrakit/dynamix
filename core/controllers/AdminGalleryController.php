<?php

class AdminGalleryController extends BaseController {

	private $file_format = array('.jpg','.png','.jpeg','.gif','.JPG','.PNG','.JPEG','.GIF');


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		// get all the nerds
		$mosaiques = Mosaique::all();

		// load the view and pass the nerds
		return View::make('admin.gallery.index', compact('mosaiques'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{

		return View::make('admin.gallery.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$inputs = Input::all();
		$inputs['url'] = '/'.Str::slug($inputs['title']);

        $validator = Validator::make($inputs, Config::get('validator.gallery'));

		// process the login
		if ($validator->passes()) {
			$gallery = new Gallery();
            $gallery->title     		= $inputs['title'];
            $gallery->url 				= $inputs['url'];
            $gallery->description       = $inputs['description'];

            $gallery->meta_title       = $inputs['meta_title'];
            $gallery->meta_description = $inputs['meta_description'];

            $gallery->cover_id = 0;
            $gallery->mosaique_id = $inputs['mosaique_id'];

            $gallery->created_at    	= new DateTime();
            $gallery->updated_at    	= new DateTime();

            // Was the blog post created?
            if($gallery->save())
            {
            	//-----------
	            //COVER
	            //-----------
	            // ex : http://localhost/uploads/myfileeruobvieubr.jpg
	            $image = new Image();

	            //Décomposition de la chaine de caractere pour obtenir le nom du fichier et lextention séparé
	            $file_name = basename( $inputs['cover_id'] );
	            //$file_format = array('.jpg','.png','.jpeg','.gif');
	            $file_ext = null;

	            //Searching extention
	            foreach($this->file_format as $format){
	            	if(strpos($file_name,$format) !== false){
	            		$file_ext = $format;
	            	}
	            }

	            if($file_ext === null){
	            	return Redirect::to('admin/gallery/create')->withInput()->with('error','Il y a un problème avec l\'image de couverture...');
	            }

	            $image->file_name	= basename($file_name,$file_ext);
	            $image->file_ext	= substr($file_ext, 1 , strlen($file_ext)-1);
	            $image->gallery_id	= $gallery->id;
	            $image->order	= 0;//0 cause this is a cover

	            if(!$image->save()){
	            	return Redirect::to('admin/gallery/create')->withInput()->with('error','Il y a un eu un problème lors de l\'enregistrement de l\'image de couverture...');
	            }

	            Cache::forget('DB_Urls');

	            $gallery->cover_id = $image->id;
	            $gallery->save();

                // Redirect to the new blog post gallery
                return Redirect::to('admin/gallery')->with('success','La galerie à bien été créée !');
            }

            // Redirect to the blog post create gallery
            return Redirect::to('admin/gallery/create')->with('error', 'La galerie n\'a pas pu être enregistrée...');
        }

        // Form validation failed
        return Redirect::to('admin/gallery/create')->withInput()->withErrors($validator);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		// get the nerd
		$gallery = Gallery::find($id);
		$images = Image::where('gallery_id','=',$id)->orderBy('order','ASC')->get();

		// show the view and pass the nerd to it
		return View::make('admin.gallery.show', compact('gallery','images'));
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
		$gallery = Gallery::find($id);

		// show the edit form and pass the nerd
		return View::make('admin.gallery.edit', compact('gallery'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$inputs = Input::all();
		$inputs['url'] = '/'.Str::slug($inputs['title']);

        $validator = Validator::make($inputs, Config::get('validator.gallery_edit'));

		// process the login
		if ($validator->passes()) {
			$gallery = Gallery::find($id);
			if(empty($gallery)){
				return Redirect::to('admin/gallery')->with('error','Cette galerie n\'existe pas !');
			}
            $gallery->title     		= $inputs['title'];

            //Check url
            if($gallery->url != $inputs['url']){
            	//check is url is'nt exists
            	$pages_url = Page::where('url','=',$inputs['url'])->get();
            	$galleries_url = Gallery::where('id','<>',$id)->where('url','=',$inputs['url'])->get();
            	$mosaiques_url = Mosaique::where('url','=',$inputs['url'])->get();
            	if(count($pages_url) != 0 || count($galleries_url) != 0 || count($mosaiques_url) != 0){
            		return Redirect::to('admin/gallery/'.$id.'/edit')->with('error','Le titre (et l\'url généré) sont déjà prise... Veuillez changer de titre.');
            	}
            }
            $gallery->url 				= $inputs['url'];
            $gallery->description       = $inputs['description'];

            $gallery->meta_title       = $inputs['meta_title'];
            $gallery->meta_description = $inputs['meta_description'];

            //$gallery->cover_id = 0;
            $gallery->mosaique_id = $inputs['mosaique_id'];

            $gallery->updated_at    	= new DateTime();

            // Was the blog post created?
            if($gallery->save())
            {
            	Cache::forget('DB_Urls');

            	//-----------
	            //COVER
	            //-----------
	            // ex : http://localhost/uploads/myfileeruobvieubr.jpg
	            $image = Image::find(Input::get('cover_real_id'));

	            //Décomposition de la chaine de caractere pour obtenir le nom du fichier et lextention séparé
	            $file_name = basename( $inputs['cover_id'] );
	            //$file_format = array('.jpg','.png','.jpeg','.gif');
	            $file_ext = null;

	            //Searching extention
	            foreach($this->file_format as $format){
	            	if(strpos($file_name,$format) !== false){
	            		$file_ext = $format;
	            	}
	            }

	            if($file_ext === null){
	            	return Redirect::to('admin/gallery/' . $id . '/edit')->withInput()->with('error','Il y a un problème avec l\'image de couverture...');
	            }

	            if( basename($file_name,$file_ext) != $image->file_name || substr($file_ext, 1 , strlen($file_ext)-1) != $image->file_ext){
	            	$image = new Image();
		            $image->file_name	= basename($file_name,$file_ext);
		            $image->file_ext	= substr($file_ext, 1 , strlen($file_ext)-1);
		            $image->gallery_id	= $gallery->id;
		            $image->order	= 0;//0 cause this is a cover
		            
		            DB::table('images')->where('gallery_id','=',$id)->increment('order');
		            
		            if(!$image->save()){
		            	return Redirect::to('admin/gallery/' . $id . '/edit')->withInput()->with('error','Il y a un eu un problème lors de l\'enregistrement de l\'image de couverture...');
		            }
	            	
	            	$gallery->cover_id = $image->id;
	            	$gallery->save();
	            }


                // Redirect to the new blog post gallery
                return Redirect::to('admin/gallery')->with('success','La galerie à bien été modifiée !');
            }

            // Redirect to the blog post create gallery
            return Redirect::to('admin/gallery/' . $id . '/edit')->with('error', 'La galerie n\'a pas pu être modifiée...');
        }

        // Form validation failed
        return Redirect::to('admin/gallery/' . $id . '/edit')->withInput()->withErrors($validator);
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
		$gallery = Gallery::find($id);
		$gallery->images()->delete();
		$gallery->delete();

		Cache::forget('DB_Urls');

		// redirect
		Session::flash('success', 'La galerie à bien été supprmée !');
		return Redirect::to('admin/gallery');
	}



	public function postAddImage(){
        $image = new Image();

        //Décomposition de la chaine de caractere pour obtenir le nom du fichier et lextention séparé
        $file_name = basename( Input::get('url_image') );
        //$file_format = array('.jpg','.png','.jpeg','.gif','.JPG','.PNG','.JPEG','.GIF');
        $file_ext = null;

        //Searching extention
        foreach($this->file_format as $format){
        	if(strpos($file_name,$format) !== false){
        		$file_ext = $format;
        	}
        }

        if($file_ext === null){
        	return Redirect::to('admin/gallery/' . Input::get('gallery_id'))->withInput()->with('error','Il y a un problème avec l\'image de couverture...');
        }

        $image->file_name	= basename($file_name,$file_ext);
        $image->file_ext	= substr($file_ext, 1 , strlen($file_ext)-1);
        $image->gallery_id	= Input::get('gallery_id');

        switch(Input::get('where')){
        	case 'before':
        		$image->order = 0;
        		
        		DB::table('images')->where('gallery_id','=',Input::get('gallery_id'))->increment('order');
        		
        		break;
        	case 'after':
        		$image->order = $image->getMaxOrder() + 1;
        		break;
        }

        if($image->save()){
       		return Redirect::to('admin/gallery/' . Input::get('gallery_id'))->withInput()->with('success','Félicitations ! Vous avez ajouté une image :)');
        }
        
        return Redirect::to('admin/gallery/' . Input::get('gallery_id'))->withInput()->with('error','Il y a un eu un problème lors de l\'enregistrement de l\'image de couverture...');
	}

	public function move($order){
		// find resource
		$image = Image::where('gallery_id','=',Input::get('gallery_id'))->where('order','=',$order)->first();

		if( !empty($image) ){
			//identify the direction
			$direction = Input::get('direction');

			switch ($direction) {
				case 'right':
					$imageRighter = Image::where('gallery_id','=',Input::get('gallery_id'))->where('order','=',$image->order + 1)->first();
					$imageRighter->order = $image->order;
					$image->order = $image->order + 1;
					if( $image->save() && $imageRighter->save() ){
						return Redirect::to('admin/gallery/' . Input::get('gallery_id'))->with('success','L\'opération s\'est excécuté avec succès !');
					}
					break;
				case 'left':
					$imageLefter = Image::where('gallery_id','=',Input::get('gallery_id'))->where('order','=',$image->order - 1)->first();
					$imageLefter->order = $image->order;
					$image->order = $image->order - 1;
					if( $image->save() && $imageLefter->save() ){
						return Redirect::to('admin/gallery/' . Input::get('gallery_id'))->with('success','L\'opération s\'est excécuté avec succès !');
					}
					break;
			}

			return Redirect::to('admin/gallery/' . $image->gallery_id)->with('error','Il y a eu un problème lors de l\'opération...');
		}

		return Redirect::to('admin/gallery/' . $image->gallery_id)->with('error','gallery introuvable !');
	}

}