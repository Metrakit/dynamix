<?php

class AuthController extends BaseController {

	/**
	 * Constructor
	 *
	 * @return Response
	 */
	/*public function __construct(User $user)
	{
		$this->user = $user;
	}*/

	
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

		return View::make('auth.login');
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
			'password' => Input::get( 'password' ));

		// Validate the inputs
		$validator = Validator::make(Input::all(), Config::get('validator.login'));

        // Check if the form validates with success
		if ( $validator->passes() ){

			// redirect the user back to the intended page
			// or defaultpage if there isn't one
			if (Auth::attempt($credentials,true)) {
				//track user
				parent::track('loggin','Auth',Auth::user()->id);

				$user = Auth::user();
				$user->last_visit_at = new Datetime;
				$user->save();

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



	/**
	 * get the page with all langue activated
	 *
	 * @return Response
	 */
	public function choose_your_language()
	{
		return View::make('public.i18n.choose-your-language');
	}


}