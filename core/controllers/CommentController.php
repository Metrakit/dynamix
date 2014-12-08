<?php

class CommentController extends BaseController {

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
	public function store()
	{
		//Define URL for redirection
		$url = ( Input::has('url') ? Input::get('url') : URL::to('/'));

		//Check auth
		$user = Auth::user();
		if ( empty($user) ) {
			if ( Request::ajax() ) {
				return Response::json(array('status' => 'notice', 'message' => Lang::get('auth.you_must_be_logged')));
			} else {
				return Redirect::to($url)->with('notice_comment', Lang::get('auth.you_must_be_logged'));
			}
		}

		// Validate the inputs
		$validator = Validator::make(Input::except('_token','referer'), Config::get('validator.comment'));

        // Check if the form validates with success
		if ( $validator->passes() ){
			$comment = new Comment;
			$comment->user_id = $user->id;
			$comment->text = Input::get('message');
			$comment->commentable_id = Input::get('commentable_id');
			$comment->commentable_type = Input::get('commentable_type');
			
			$comment->locale_id = App::getLocale();
			if ( $comment->save() ) {
				if ( Request::ajax() ) {
					return Response::json(array('status' => 'success', 'message' => Lang::get('comment.store_success')));
				} else {
					return Redirect::to($url)->with('success', Lang::get('comment.store_success'));
				}
			}

			if ( Request::ajax() ) {
				return Response::json(array('status' => 'error', 'message' => Lang::get('comment.store_fail')));
			} else {
				return Redirect::to($url)->with('error', Lang::get('comment.store_fail'));
			}
		}

		if ( Request::ajax() ) {
			return Response::json(array('status' => 'error', 'message' => $validator->messages()->all()));
		} else {
			return Redirect::to($url)->withInput()->withErrors($validator);
		}
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

				/*$user = Auth::user();
				$user->last_visit_at = new Datetime;
				$user->save();*/

				return Redirect::intended('/');
			} else {
				$user = AuthUser::where('email','=', Input::get( 'email' ) )->first();

				if ( empty($user) || !isset($user) ) {
					return Redirect::to('/auth/login')->with('error', Lang::get('auth.unknow_email'))->withInput(Input::except('password'));
				}

				return Redirect::to('/auth/login')->with('error', Lang::get('auth.incorrect_password'))->withInput(Input::except('password'));
			}

			$this->user = $user;
			return Redirect::to('/');
		}

		return Redirect::to('/auth/login')->withInput()->withErrors($validator);
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
			return Redirect::to('auth/login')->with('notice', Lang::get('user.you_must_be_logged'));
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