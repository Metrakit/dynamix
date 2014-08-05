<?php

class BlogController extends BaseController {

    /**
     * Inject the models.
     * @param Post $post
     * @param User $user
     */
    public function __construct(Post $post, User $user)
    {
        $this->post = $post;
        $this->user = $user;
    }

	/**
	 * Display index of blog
	 *
	 * @return Response
	 */
	public function index()
	{
        // Get top 10 of all posts
        $posts = $this->post->orderBy( 'created_at' , 'DESC' )->where('isStatic','=',0)->paginate( 5 );

        return View::make( 'site.posts.post-group' , compact('posts') );
	}

	/**
	 * View a blog post.
	 *
	 * @param  string  $slug
	 * @return View
	 * @throws NotFoundHttpException
	 */
	public function getView($slug)
	{
		// Get this blog post data
		$post = Post::where( 'slug' , '=' , $slug )->first();
		//$post = $this->post->where('slug', '=', $slug)->first();

		// Check if the blog post exists
		if (is_null($post))
		{
			// If we ended up in here, it means that
			// a page or a blog post didn't exist.
			// So, this means that it is time for
			// 404 error page.
			return App::abort(404);
		}

		// Get this post comments
		$comments = $post->comments()->orderBy('created_at', 'ASC')->get();

        // Get current user and check permission
        $canComment = false;
        //return var_dump($user);
        if(Auth::check()) {
            $canComment = Auth::user()->hasRole('comment');
        }

		// Show the page
		return View::make('site.posts.post', compact('post', 'comments', 'canComment'));
	}

	/**
	 * View a blog post.
	 *
	 * @param  string  $slug
	 * @return Redirect
	 */


	public function postView($slug)
	{
		//Check if auth, and admin
		if(Auth::check()){
			if(Auth::user()->hasRole('admin')){
				// Get this blog post data
				$post = Post::where('slug', '=', $slug)->first();

				// Validate the inputs
				$validator = Validator::make(Input::all(), Config::get('validator.comment-admin'));

				if ($validator->passes())
				{
					// Save the comment
					$comment = new Comment;
					$comment->user_id = Auth::user()->id;
					$comment->content = Input::get('comment');
					$comment->isConfirm = true;

					// Was the comment saved with success?
					if($post->comments()->save($comment))
					{
						// Redirect to this blog post page
						Session::flash('success', 'Votre avis à été enregistré avec succès !');
						return Redirect::to($slug . '#comments');
					}

					// Redirect to this blog post page
					Session::flash('error', 'Il y a eu un problème lors de l\'enregistrement de votre avis... S\'il vous plaît, veuillez réessayer.');
					return Redirect::to($slug . '#comments');
				}

				// Redirect to this blog post page
				return Redirect::to($slug)->withInput()->withErrors($validator);
			}
		}
        $canComment = true;

		// Get this blog post data
		$post = Post::where('slug', '=', $slug)->first();

		// Validate the inputs
		$validator = Validator::make(Input::all(), Config::get('validator.comment'));

		// Check if the form validates with success
		if ($validator->passes())
		{
			//Check if the user exists in base
			$user = User::where('email','=',Input::get('email'))->first();
			if(!isset($user) || empty($user)){
				$user = new User;
				$user->email = Input::get('email');
				$user->pseudo = Input::get('name');
				if( !$user->save() ){
					Session::flash('error', 'Une erreur est survenu lors de l\'enregistrement de votre compte temporaire... Veillez nous-en excuser.');
					return Redirect::to($slug . '#comments');
				}
			}

			//Data to mail
			$data['comment'] 	= Input::get('comment');
			$data['email'] 		= Input::get('email');
			$data['name'] 		= Input::get('name');
			$data['urlEncrypt'] = strtolower(Crypt::encrypt(md5(trim(mt_rand()))));
			
			// Save the comment
			$comment = new Comment;
			$comment->user_id = $user->id;
			//$comment->user_id = Auth::user()->id;
			$comment->content = Input::get('comment');
			$comment->isConfirm = false;
			$comment->sha = $data['urlEncrypt'];

			// Was the comment saved with success?
			if($post->comments()->save($comment))
			{
				Mail::pretend();
				$data['commentID'] 	= $comment->id;
				//Log::info($data['urlEncrypt']);

				Mail::queue('emails.html-template', $data, function($message)
				{
					Log::info('Couuucouuuuu');
				    $message->to('d.lepaux@gmail.com', 'John Smith')->subject('Un nouvel avis !');
				});

				// Redirect to this blog post page
				Session::flash('success', 'Votre avis à été enregistré avec succès !');
				return Redirect::to($slug . '#comments');
			}

			// Redirect to this blog post page
			Session::flash('error', 'Il y a eu un problème lors de l\'enregistrement de votre avis... S\'il vous plaît, veuillez réessayer.');
			return Redirect::to($slug . '#comments');
		}

		// Redirect to this blog post page
		return Redirect::to($slug)->withInput()->withErrors($validator);
	}



	public function getAction($id, $bool, $sha){
		$comment = Comment::find($id);
		if(empty($comment)){
			return Redirect::to('actualites')->with('error','L\'avis n\'existe pas !');
		}

		if($comment->sha == $sha){
			if($bool == 'authorised') {
				$comment->sha = '';
				$comment->isConfirm = true;
				$comment->save();
				
				Session::flash('success','L\'avis a bien été publié');
				return Redirect::to('actualites');
			}else{
				$comment->delete();
				Session::flash('success','L\'avis a bien été supprimé');
				return Redirect::to('actualites');
			}

		}
		Log::info('DANGER_INCORRECT_KEY');
		return Redirect::to('actualites')->with('error','La clé est incorrecte !');
	}



}