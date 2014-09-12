<?php

class UserController extends BaseController {

	/**
	 * Constructor
	 *
	 * @return Response
	 */
	public function __construct(User $user)
    {
        $this->user = $user;
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		if ( Auth::check() ) {
			$user = Auth::user();

			if ( !empty($user) ) {				
				if ( $user->hasRole('admin') ) {
			        //Show the page
					return View::make('user.create');
				}
			}
			App::abort(403);
		} else {
			return Redirect::to('user/login')->with('notice', Lang::get('user.you_must_be_logged'));
		}
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		if ( Auth::check() ) {
			$user = Auth::user();

			if ( !empty($user) ) {			
				if ( $user->hasRole('admin') ) {
					// Validate the inputs
			        $validator = Validator::make(Input::all(), Config::get('validator.register'));

			        $user = User::where('email','=',Input::get('email'))->first();
			        if(!empty($user) || isset($user)){
			        	return Redirect::to('user/create')->with( 'error', Lang::get('user.email_already_exists') );
			        }

			        // Check if the form validates with success
			        if ($validator->passes())
			        {
			        	$this->user->pseudo			= Input::get('pseudo');
			        	$this->user->lastname		= Input::get('lastname');
			        	$this->user->firstname		= Input::get('firstname');
			        	$this->user->email			= Input::get('email');
			        	$this->user->password		= Hash::make(Input::get('password'));
			        	$this->user->save();
			        	
			        	//Role
			        	$this->user->roles()->attach(2);

			        	//if no error when save
			        	if($this->user->id){
			            	return Redirect::to('user/login')->with( 'notice', Lang::get('user.user_account_created') )->with( 'email' , Input::get('email') );
			        	}
				        else
				        {
				        	return Redirect::to('user/create')->with( 'error', Lang::get('user.error_saving') );
				        }
				    }
				    
					// Show the page
			        return Redirect::to('/user/create')->withInput(Input::except('password'))->withErrors($validator);
			    }
		    }
			App::abort(403);
		} else {
			return Redirect::to('user/login')->with('notice', Lang::get('user.you_must_be_logged'));
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		if ( Auth::check() ) {
			$user = Auth::user();
			if ( !empty($user) ) {							
				if ( $user->hasRole('admin') ) {
		        	//Show the page
					return View::make('user.edit', compact('user'));
				}
			}
			App::abort(403, Lang::get('user.you_are_not_authorized'));
		} else {
			return Redirect::to('user/login')->with('notice', Lang::get('user.you_must_be_logged'));
		}
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		if ( Auth::check() ) {
			$user = Auth::user();
			if ( !empty($user) ) {				
				if ( $user->hasRole('admin') ) {
					// Validate the inputs
			        $validator = Validator::make(Input::all(), Config::get('validator.register'));
			        
			        // Check if the form validates with success
			        if ( $validator->passes() ) {
			        	if ( Hash::check(Input::get('oldpassword') , $this->user->password) ) {
				        	$this->user->pseudo			= Input::get('pseudo');
				        	$this->user->lastname		= Input::get('lastname');
				        	$this->user->firstname		= Input::get('firstname');
				        	$this->user->email			= Input::get('email');
				        	$this->user->password		= Hash::make(Input::get('password'));

				        	//if no error when save
				        	if ($this->user->save()){
				            	return Redirect::to('user')->with( 'notice', Lang::get('user.account_updated') );
				        	} else {
					        	return Redirect::to('user/'.$this->user->id.'/edit')->with( 'error', Lang::get('user.error_saving') );
					        }
			        	} else {
			        		return Redirect::to('user/'.$this->user->id.'/edit')->with( 'error', Lang::get('user.icorrect_old_password') );
			        	}        	
				    }

					// Show the page
					return Redirect::to('/user/'.$this->user->id.'/edit')->withInput(Input::except('password'))->withErrors($validator);
				}
			}

			App::abort(403, Lang::get('user.you_are_not_authorized'));
		} else {
			return Redirect::to('user/login')->with('notice', Lang::get('user.you_must_be_logged'));
		}
	}

	
	/**
	 * Show the display for logging
	 *
	 * @return Response
	 */
	public function login()
	{
		$user = Auth::user();
        if ( !empty($user->id) ) {
            return Redirect::to('/');
        }

		return View::make('user.login');
	}

	/**
	 * Log an user
	 *
	 * @return Response
	 */
	public function post_login()
	{
		//Login the user
		$credentials = array(
            'email'    => Input::get( 'email' ),
            'password' => Input::get( 'password' )
        );
       
		// Validate the inputs
        $validator = Validator::make(Input::all(), Config::get('validator.login'));

        // Check if the form validates with success
        if ( $validator->passes() ){

			// redirect the user back to the intended page
			// or defaultpage if there isn't one
			if (Auth::attempt($credentials,true)) {
			    return Redirect::intended('/');
			} else {
        		$user = User::where('email','=', Input::get( 'email' ) )->first();
        		
        		if ( empty($user) || !isset($user) ) {
					return Redirect::to('/user/login')->with('error', Lang::get('user.unknow_email'))->withInput(Input::except('password'));
        		}

				return Redirect::to('/user/login')->with('error', Lang::get('user.incorrect_password'))->withInput(Input::except('password'));
			}

			$this->user = $user;
        	return Redirect::to('/');
        }

        return Redirect::to('/user/login')->withInput()->withErrors($validator);
	}

	/**
	 * Loggout an user
	 *
	 * @return Response
	 */
	public function logout(){
		Auth::logout();
		return Redirect::to('/');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		if ( Auth::check() ) {
			$user = Auth::user();
			if ( !empty($user) ) {							
				if ( $user->hasRole('admin') ) {
					$user = User::find($id);
					if(!empty($user) || isset($user) ){
						$user->delete();
					}
				}
			}

			App::abort(403, Lang::get('user.you_are_not_authorized'));
		} else {
			return Redirect::to('user/login')->with('notice', Lang::get('user.you_must_be_logged'));
		}
	}
}