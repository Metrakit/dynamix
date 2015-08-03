<?php

class AuthController extends BaseController {

	private $credentials;

	private $validator;

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
	public function adminLogin()
	{
		$user = Auth::user();
		if ( !empty($user->id) ) {
			return Redirect::to('/');
		}

		return View::make('theme::admin.login.login');
	}

	/**
	 * Log an user
	 *
	 * @return Response
	 */
	public function postAdminLogin()
	{
        // Check if the form validates with success
		if ( $this->checkLogin() ){
			
			// redirect the user back to the intended page
			// or defaultpage if there isn't one
			if (Auth::attempt($this->credentials, true)) {
				//track user
				parent::track('loggin', 'Auth', Auth::user()->id);

				return Redirect::intended('index_admin');
			} else {
				$user = AuthUser::where('email', Input::get('email'))->first();

				if ( empty($user) || !isset($user) ) {
					return Redirect::route('admin.login')->with('error', I18n::get('auth.unknow_email'))->withInput(Input::except('password'));
				}

				return Redirect::route('admin.login')->with('error', I18n::get('auth.incorrect_password'))->withInput(Input::except('password'));
			}

			$this->user = $user;
			return Redirect::to('/');
		}

		return Redirect::route('admin.login')->withInput()->withErrors($this->validator);
	}


	/**
	 * Show the display for logging
	 *
	 * @return Response
	 */
	public function publicLogin()
	{
		$user = Auth::user();
		if ( !empty($user->id) ) {
			return Redirect::to('/');
		}

		return View::make('theme::public.user.login');
	}

	/**
	 * Log an user
	 *
	 * @return Response
	 */
	public function postPublicLogin()
	{
        // Check if the form validates with success
		if ( $this->checkLogin() ){
			// return var_dump($this->credentials);
			// redirect the user back to the intended page
			// or defaultpage if there isn't one
			if (Auth::attempt($this->credentials, true)) {
				//track user
				parent::track('loggin', 'Auth', Auth::user()->id);

				return Redirect::intended('/');
				if (Request::ajax()) {
					return Response::json(array('statut' => 'success', 'message' => I18n::get('auth.login-success'), 'user_id' => User::getIdByAuth(Auth::user()->id)));
				} else {
					return Redirect::route('public.login')->with('error', I18n::get('auth.login-success'))->withInput(Input::except('password'));
				}
			} else {
				$user = AuthUser::where('email', Input::get('email'))->first();

				if ( empty($user) || !isset($user) ) {
					if (Request::ajax()) {
						return Response::json(array('statut' => 'danger', 'message' => I18n::get('auth.unknow_email')));
					} else {
						return Redirect::route('public.login')->with('error', I18n::get('auth.unknow_email'))->withInput(Input::except('password'));
					}
				}
				if (Request::ajax()) {
						return Response::json(array('statut' => 'danger', 'message' => I18n::get('auth.incorrect_password')));
					} else {
						return Redirect::route('public.login')->with('error', I18n::get('auth.incorrect_password'))->withInput(Input::except('password'));
					}
			}
			$this->user = $user;
			return Redirect::to('/');
		}
		if (Request::ajax()) {
				return Response::json(array('statut' => 'danger', 'message' => I18n::get('auth.incorrect_password')));
			} else {
				return Redirect::route('public.login')->withInput()->withErrors($this->validator);
			}
	}


	public function checkLogin()
	{
		//Login the user
		$this->credentials = array(
			'email'    => Input::get( 'email' ),
			'password' => Input::get( 'password' ));

		// Validate the inputs
		$this->validator = Validator::make(Input::all(), Config::get('validator.login'));

        // Check if the form validates with success
		return $this->validator->passes();
	}

	/**
	 * Loggout an user (admin or simple)
	 *
	 * @return Response
	 */
	public function logout()
	{
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

			App::abort(403, I18n::get('auth.you_are_not_authorized'));
		} else {
			return Redirect::route('admin.login')->with('notice', I18n::get('auth.you_must_be_logged'));
		}
	}



	/**
	 * get the page with all langue activated
	 *
	 * @return Response
	 */
	public function choose_your_language()
	{
		return View::make('theme::public.i18n.choose-your-language');
	}


}