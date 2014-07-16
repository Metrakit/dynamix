<?php

class AdminController extends BaseController {

	public function __construct(User $user)
    {
        $this->user = $user;
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

        $posts = Post::where('isStatic','=',false)->orderBy('created_at','DESC')->get()->take(5);
        $pages = Post::where('isStatic','=',true)->orderBy('created_at','DESC')->get()->take(5);
        $comments = Comment::orderBy('created_at','DESC')->get()->take(5);
        $registers = User::orderBy('created_at','DESC')->get()->take(5);

		return View::make('admin.index', compact('user', 'posts', 'pages', 'comments', 'registers'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		
	}

}