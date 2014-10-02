<?php

class AdminUserController extends BaseController {


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		//Check permission
		if ( !Auth::user()->hasPermission('manage','user') ) return Redirect::to('admin')->with('error', Lang::get('user.you_are_not_authorized'));

		//User
		$data['user'] = Auth::user();
		
		//All users
		$data['users'] = User::all();

		//Interface
		$data['noAriane'] = true;

		return View::make('admin.user.index', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		//User
		$data['user'] 			= Auth::user();

		//Interface
		$data['noAriane'] 		= true;
		$data['buttonLabel'] 	= Lang::get('button.add');
		$data['glyphicon'] 		= 'plus';

		//Role
		$data['roles'] 			= Role::all();

		return View::make('admin.user.create', $data);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $validator = Validator::make($inputs, Config::get('validator.admin.user_create'));

		// process the login
		if ($validator->passes()) {

			$user = new User();
			$user->pseudo		= Input::get('pseudo');
			$user->firstname	= Input::get('firstname');
			$user->lastname		= Input::get('lastname');
			//$user->roles		= Input::get('email'); see laravel doc to set tihis up!
			$user->email		= Input::get('email');
			$user->password		= Hash::make(Input::get('password'));

			if( $user->save() ) {
	            // Redirect to the new blog post user
	            return Redirect::to('admin/user')->with('success', Lang::get('admin.user_create_success'));
			}
		
            // Redirect to the blog post create user
            return Redirect::to('admin/user/create')->with('error', Lang::get('admin.user_create_fail'));
        }

        // Form validation failed
        return Redirect::to('admin/user/create')->withInput()->withErrors($validator);
	}


	public function showProfil () {
		//data
		$data['user'] 			= Auth::user();

		//Interface
		$data['noAriane'] 		= true;


		//need design of a profil...
		return View::make('admin.user.profil_show', $data);
	}

	public function editProfil () {
		//data
		$data['user'] 			= Auth::user();

		//Interface
		$data['noAriane'] 		= true;

		//design oof profil in editing mode
		return View::make('admin.user.profil_edit', $data);
	}

	public function updateProfil () {
		$user = Auth::user();

		$validator = Validator::make($inputs, Config::get('validator.admin.user_profil'));

		// process the login
		if ($validator->passes()) {

			if ( Hash::check(Input::get('oldpassword') , $user->password) ) {
	        	$user->pseudo		= Input::get('pseudo');
	        	$user->lastname		= Input::get('lastname');
	        	$user->firstname	= Input::get('firstname');
	        	$user->email		= Input::get('email');
	        	$user->password		= Hash::make(Input::get('password'));

	        	//if no error when save
	        	if ($user->save()){
	            	return Redirect::to('admin/user/profil')->with( 'success', Lang::get('user.account_updated') );
	        	} else {
		        	return Redirect::to('admin/user/'.$user->id.'/edit')->with( 'error', Lang::get('user.error_saving') );
		        }
        	} else {
        		return Redirect::to('admin/user/'.$user->id.'/edit')->with( 'error', Lang::get('user.icorrect_old_password') );
        	} 
		
            // Redirect to the blog post create user
            return Redirect::to('admin/user/create')->with('error', Lang::get('admin.user_create_fail'));
        }

        // Form validation failed
        return Redirect::to('admin/user/create')->withInput(Input::except('password'))->withErrors($validator);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//Interface
		$data['noAriane'] 		= true;
		$data['buttonLabel'] 	= Lang::get('button.update');
		$data['glyphicon'] 		= 'ok';

	    $data['user'] = User::find($id);

	    if(empty($data['user'])) return Redirect::back()->with('error', Lang::get('admin.user_empty') );

		return View::make('admin.user.edit_role', $data);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//todoo inspirate in edit profil + role
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
		$user = User::find($id);

		if( !empty($user) ) {
			if ( $user->delete() ) {
				return Redirect::to('admin/user')->with('success', Lang::get('admin.user_delete_success'));
			}
		}
		return Redirect::to('admin/user')->with('error', Lang::get('admin.user_delete_fail'));
	}
}