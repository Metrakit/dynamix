<?php

use Symfony\Component\HttpFoundation\File\UploadedFile;

class AdminPageController extends BaseController {

	public function __construct(User $user, Post $post)
    {
        $this->user = $user;
        $this->post = $post;
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		list($user,$redirect) = $this->user->checkAdminAndRedirect('user');
        if($redirect){return $redirect;}

        $pages = Post::where('isStatic','=',true)->paginate(15);

		return View::make('admin.page.index', compact('user','pages'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		list($page) = $this->post;

		return View::make('admin.page.create', compact('user', 'page'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        // Validate the inputs
        $validator = Validator::make(Input::all(), Config::get('validator.post'));
        
        // Check if the form validates with success
        if ($validator->passes())
        {
            // Create a new blog post
            $user = Auth::user();
            if(empty($user)){
            	return Redirect::to('user/login')->with('error','Vous devez êtres connecté !');
            }

            //Image storing
            $file = Input::file('image');
            if(!empty($file)){        
	            $destinationPath	= 'img/uploads/'.Str::random(5);
				$fileName 			= md5( Input::get('title') );
	            $uploadSuccess = $file->move($destinationPath, $fileName);

	            if( empty($uploadSuccess) ){
	            	return Redirect::to('admin/page/create')->with('error','L\'image n\' pas pu être téléchargée...');
	            }
            	$this->post->img          	  = $destinationPath.'/'.$fileName;
			}
            // Update the blog post data
            $this->post->title            = Input::get('title');
            $this->post->slug             = Str::slug(Input::get('title'));
            $this->post->content          = Input::get('content');
            $this->post->footer           = Input::get('footer');
            $this->post->meta_title       = Input::get('meta-title');
            $this->post->meta_description = Input::get('meta-description');
            $this->post->meta_keywords    = Input::get('meta-keywords');
            $this->post->created_at    	  = new DateTime();
            $this->post->user_id          = $user->id;

            // Was the blog post created?
            if($this->post->save())
            {
                // Redirect to the new blog page page
                return Redirect::to('admin/page')->with('success', 'La page à bien été créé !');
            }

            // Redirect to the blog page create page
            return Redirect::to('admin/page/create')->with('error', 'La page n\'a pas pu être enregistré...');
        }

        // Form validation failed
        return Redirect::to('admin/page/create')->withInput()->withErrors($validator);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$page = Post::find($id);
		if(empty($page) || !isset($page)){
			return Redirect::to('admin/page')->with('error','Cette page est introuvable !');
		}

		$comments = $page->comments()->orderBy('created_at', 'ASC')->get();

        // Get current user and check permission
        $canComment = false;
        //return var_dump($user);
        if(Auth::check()) {
            $canComment = Auth::user()->hasRole('comment');
        }

		return View::make('admin.page.show', compact('page', 'comments', 'canComment'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		// get the post
		$page = Post::find($id);

		if(empty($page) || !isset($page)){
			//Session::flash('error', 'Ce post est introuvable !');
			return Redirect::back()->with('error', 'Cette page est introuvable !');
		}

		// show the edit form and pass the post
		return View::make('admin.page.edit', compact('page') );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		// Validate the inputs
        $validator = Validator::make(Input::all(), Config::get('validator.post'));
		
        // Check if the form validates with success
        if ($validator->passes())
        {
            $page = Post::find($id);
            if(empty($page) || !isset($page)){
				return Redirect::to('admin/page')->with('error','Cette page est introuvable !');
			}

             //Image storing
            $file = Input::file('image');
            if(!empty($file)){        
	            $destinationPath	= 'img/uploads/'.Str::random(5);
				$fileName 			= md5( Input::get('title') );
	            $uploadSuccess = $file->move($destinationPath, $fileName);

	            if( empty($uploadSuccess) ){
	            	return Redirect::to('admin/page/create')->with('error','L\'image n\' pas pu être téléchargée...');
	            }

				$page->img          	= $destinationPath.'/'.$fileName;
			}


            // Update the blog post data
            $page->title            = Input::get('title');
            $page->slug             = Str::slug(Input::get('title'));
            $page->content          = Input::get('content');
            $page->footer           = Input::get('footer');
            $page->meta_title       = Input::get('meta-title');
            $page->meta_description = Input::get('meta-description');
            $page->meta_keywords    = Input::get('meta-keywords');
            $page->updated_at    	= new DateTime();

            // Was the blog post created?
            if($page->save())
            {
                // Redirect to the new blog post page
                return Redirect::to('admin/page')->with('success','La page à bien été mise à jour !');
            }

            // Redirect to the blog post create page
            return Redirect::to('admin/page/' . $id . '/edit')->with('error', 'La page n\'a pas pu être enregistré...');
        }

        // Form validation failed
        return Redirect::to('admin/page/' . $id . '/edit')->withInput()->withErrors($validator);;
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
		$page = Post::find($id);
		if(empty($page)){
			Session::flash('error', 'Ce page est introuvable !');
			return Redirect::back();
		}
		$page->delete();

		// redirect
		Session::flash('success', 'Le page a bien été supprimé !');
		return Redirect::back();
	}
}