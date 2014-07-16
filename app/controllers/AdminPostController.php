<?php

use Symfony\Component\HttpFoundation\File\UploadedFile;

class AdminPostController extends BaseController {

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

        $posts = Post::where('isStatic','=',false)->paginate(15);

		return View::make('admin.post.index', compact('user','posts'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		list($post) = $this->post;

		return View::make('admin.post.create', compact('user', 'post'));
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
	            	return Redirect::to('admin/post/create')->with('error','L\'image n\' pas pu être téléchargée...');
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
                // Redirect to the new blog post page
                return Redirect::to('admin/post')->with('success', 'L\'article à bien été créé !');
            }

            // Redirect to the blog post create page
            return Redirect::to('admin/post/create')->with('error', 'L\'article n\'a pas pu être enregistré...');
        }

        // Form validation failed
        return Redirect::to('admin/post/create')->withInput()->withErrors($validator);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$post = Post::find($id);
		if(empty($post) || !isset($post)){
			return Redirect::to('admin/post')->with('error','Cette article est introuvable !');
		}

		$comments = $post->comments()->orderBy('created_at', 'ASC')->get();

        // Get current user and check permission
        $canComment = false;
        //return var_dump($user);
        if(Auth::check()) {
            $canComment = Auth::user()->hasRole('comment');
        }

		return View::make('admin.post.show', compact('post', 'comments', 'canComment'));
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
		$post = Post::find($id);

		if(empty($post) || !isset($post)){
			//Session::flash('error', 'Ce post est introuvable !');
			return Redirect::back()->with('error', 'Cette article est introuvable !');
		}

		// show the edit form and pass the post
		return View::make('admin.post.edit', compact('post') );
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
            $post = Post::find($id);
            if(empty($post) || !isset($post)){
				return Redirect::to('admin/post')->with('error','Cette article est introuvable !');
			}

             //Image storing
            $file = Input::file('image');
            if(!empty($file)){        
	            $destinationPath	= 'img/uploads/'.Str::random(5);
				$fileName 			= md5( Input::get('title') );
	            $uploadSuccess = $file->move($destinationPath, $fileName);

	            if( empty($uploadSuccess) ){
	            	return Redirect::to('admin/post/create')->with('error','L\'image n\' pas pu être téléchargée...');
	            }

				$post->img          	= $destinationPath.'/'.$fileName;
			}


            // Update the blog post data
            $post->title            = Input::get('title');
            $post->slug             = Str::slug(Input::get('title'));
            $post->content          = Input::get('content');
            $post->footer           = Input::get('footer');
            $post->meta_title       = Input::get('meta-title');
            $post->meta_description = Input::get('meta-description');
            $post->meta_keywords    = Input::get('meta-keywords');
            $post->updated_at    	= new DateTime();

            // Was the blog post created?
            if($post->save())
            {
                // Redirect to the new blog post page
                return Redirect::to('admin/post')->with('success', 'L\'article à bien été créé !');
            }

            // Redirect to the blog post create page
            return Redirect::to('admin/post/' . $id . '/edit')->with('error', 'L\'article n\'a pas pu être enregistré...');
        }

        // Form validation failed
        return Redirect::to('admin/post/' . $id . '/edit')->withInput()->withErrors($validator);;
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
		$post = Post::find($id);
		if(empty($post)){
			Session::flash('error', 'Cette article est introuvable !');
			return Redirect::back();
		}
		$post->delete();

		// redirect
		Session::flash('success', 'L\'article a bien été supprimé !');
		return Redirect::back();
	}
}