<?php

class AdminAuthController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		//Check permission
		if ( !Auth::user()->hasPermission('manage','auth') ) return Redirect::to('admin')->with('error', Lang::get('auth.you_are_not_authorized'));

		//User
		$data['user'] = Auth::user();
		
		//All users
		$data['users'] = AuthUser::all();

		//Interface
		$data['noAriane'] = true;

		if (Request::ajax()) {
			return Response::json(View::make( 'admin.auth.index', $data )->renderSections());
		} else {
			return View::make('admin.auth.index', $data);
		}
	}


	public function showProfil () {
		//data
		$data['user'] 			= Auth::user();

		//Interface
		$data['noAriane'] 		= true;

		return View::make('admin.auth.show_profil', $data);
	}

	public function editProfil () {
		//data
		$data['user'] 			= Auth::user();

		//Interface
		$data['noAriane'] 		= true;
		$data['glyphicon']		= 'ok';
		$data['buttonLabel']	= Lang::get('button.update');

		//langsBackend
		$data['langsBackend'] = Locale::where('on_admin','=',1)->orderBy('enable', 'DESC')->orderBy('id')->get();

		return View::make('admin.auth.edit_profil', $data);
	}

	public function updateProfil () {
		$user = Auth::user();

		$validator = Validator::make(Input::all(), Config::get('validator.admin.auth_profil'));

		// process the login
		if ($validator->passes()) {

			if ( Hash::check(Input::get('oldpassword') , $user->password) ) {
				$user->password		= Hash::make(Input::get('password'));

	        	//if no error when save
				if ($user->save()){
					return Redirect::to('admin/profil')->with( 'success', Lang::get('auth.account_updated') );
				} else {
					return Redirect::to('admin/profil/edit')->with( 'error', Lang::get('auth.error_saving') );
				}
			} else {
				return Redirect::to('admin/profil/edit')->with( 'error', Lang::get('auth.icorrect_old_password') );
			} 

            // Redirect to the blog post profil/edit user
			return Redirect::to('admin/profil/edit')->with('error', Lang::get('admin.auth_profil_edit_fail'));
		}

        // Form validation failed
		return Redirect::to('admin/profil/edit')->withInput(Input::except('password'))->withErrors($validator);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function editRole($id)
	{
		$data['user'] 			= Auth::user();

		//Interface
		$data['noAriane'] 		= true;
		$data['buttonLabel'] 	= Lang::get('button.update');
		$data['glyphicon'] 		= 'ok';

		$data['u'] = AuthUser::find($id);

		//Role
		$data['roles'] 			= Role::all();

		if(empty($data['u'])) return Redirect::back()->with('error', Lang::get('admin.auth_empty') );

		return View::make('admin.auth.edit_role', $data);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function updateRole($id)
	{
		//Making adaptive rules for site_name
		$role_rules = array();
		$roles = array();
		foreach ( Input::all() as $k => $v ) {
			if ( strpos($k, 'role_') !== false ) {
				$role_rules[$k] = Config::get('validator.admin.auth_role.role');
				$roles[] = substr( $k, strlen('role_'), (strlen($k) - strpos($k, 'role_')));
			}
		}

		// Validate the inputs
		$validator = Validator::make(Input::all(), $role_rules);

		// process the login
		if ($validator->passes()) {

			$user = AuthUser::find($id);
			
			//sync roles
			$user->roles()->sync($roles);

			if( $user->save() ) {
	            // Redirect to the new blog post user
				return Redirect::to('admin/auth')->with('success', Lang::get('admin.auth_edit_success'));
			}

            // Redirect to the blog post edit user
			return Redirect::to('admin/role/' . $id . '/edit')->with('error', Lang::get('admin.auth_edit_fail'));
		}

        // Form validation failed
		return Redirect::to('admin/role/' . $id . '/edit')->withInput()->withErrors($validator);
	}

}