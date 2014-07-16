<?php

class UserController extends BaseController {

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
		list($user,$redirect) = $this->user->checkAuthAndRedirect('user');
        if($redirect){return $redirect;}

		return View::make('user.index', compact('user'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('user.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		// Validate the inputs
        $validator = Validator::make(Input::all(), Config::get('validator.register'));

        $user = User::where('email','=',Input::get('email'))->first();
        if(!empty($user) || isset($user)){
        	return Redirect::to('user/create')->with( 'error', Lang::get('user/user.email_already_exists') );
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
            	return Redirect::to('user/login')->with( 'notice', Lang::get('user/user.user_account_created') )->with( 'email' , Input::get('email') );
        	}
	        else
	        {
	        	return Redirect::to('user/create')->with( 'error', Lang::get('user/user.error_saving') );
	        }
	    }
	    
		// Show the page
        return Redirect::to('/user/create')->withInput(Input::except('password'))->withErrors($validator);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$user = User::find($id);
		if(!empty($user) || isset($user) ){
			return View::make('user.show', compact('user'));
		}
		return Redirect::to('/');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		list($user,$redirect) = $this->user->checkAuthAndRedirect('user');
        if($redirect){return $redirect;}

        //Show the page
		return View::make('user.edit', compact('user'));
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
        $validator = Validator::make(Input::all(), Config::get('validator.register'));

        
        // Check if the form validates with success
        if ($validator->passes())
        {
        	$this->user = User::find($id);
        	if( Hash::check( Input::get('oldpassword') , $this->user->password ) )
        	{
	        	$this->user->pseudo			= Input::get('pseudo');
	        	$this->user->lastname		= Input::get('lastname');
	        	$this->user->firstname		= Input::get('firstname');
	        	$this->user->email			= Input::get('email');
	        	$this->user->password		= Hash::make(Input::get('password'));

	        	//if no error when save
	        	if($this->user->save()){
	            	return Redirect::to('user')->with( 'notice', Lang::get('user/user.user_account_updated') );
	        	}
		        else
		        {
		        	return Redirect::to('user/'.$this->user->id.'/edit')->with( 'error', Lang::get('user/user.error_saving') );
		        }
        	}
        	else
        	{
        		return Redirect::to('user/'.$this->user->id.'/edit')->with( 'error', Lang::get('user/user.icorrect_old_password') );
        	}
        	
	    }
	    
		// Show the page
		return Redirect::to('/user/'.$this->user->id.'/edit')->withInput(Input::except('password'))->withErrors($validator);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$user = User::find($id);
		if(!empty($user) || isset($user) ){
			$user->delete();
		}
	}

	/**
	 * Log an user
	 *
	 * @return Response
	 */
	public function login()
	{
		$user = Auth::user();
        if(!empty($user->id)){
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
        if ($validator->passes())
        {

			// redirect the user back to the intended page
			// or defaultpage if there isn't one
			if (Auth::attempt($credentials,true)) 
			{
			    return Redirect::intended('/user');
			}
			else
			{
        		$user = User::where('email','=', Input::get( 'email' ) )->first();
        		
        		if(empty($user) || !isset($user))
        		{
					return Redirect::to('/user/login')->with('error','Email inconnu !')->withInput(Input::except('password'));
        		}

				return Redirect::to('/user/login')->with('error','Mot de passe incorrect !')->withInput(Input::except('password'));

			}

        	return Redirect::to('/');
        
        }

		// Show the page
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
	 * Form for forggoten password
	 *
	 * @return Response
	 */
	public function forgot(){
		return View::make('user.forgot');
	}

	/**
	 * Form for forggoten password
	 *
	 * @return Response
	 */
	public function post_forgot(){
		$email =  Input::get( 'email' );

		// Validate the inputs
        $validator = Validator::make( Input::all() , Config::get('validator.forgot') );

        // Check if the form validates with success
        if ( $validator->passes() )
        {
        	$user = User::where('email','=',$email)->first();

        	//if user exists
        	if( isset($user) || !empty($user) )
        	{

        		//Here use the tempate email + phpMailer + password changé + modification password dans la base de donnée
        		Mail::pretend();
				Mail::queue('emails.html-template', $data, function($message)
				{
					Log::info('Couuucouuuuu');
				    $message->to('d.lepaux@gmail.com', 'John Smith')->subject('Un nouvel avis !');
				});

            	return Redirect::to('user/forgot')->with( 'notice', Lang::get('user/user.email_forgot_send') );
        	}

	        return Redirect::to('user/forgot')->with( 'error', Lang::get('user/user.dont_exists') );
	    }
	    
		// Show the page
        return Redirect::to('/user/forgot')->withInput()->withErrors($validator);
	}

}