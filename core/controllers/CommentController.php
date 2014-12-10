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
				return Response::json(array('status' => 'warning', 'message' => Lang::get('auth.you_must_be_logged')));
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
					return Response::json(array('status' => 'success', 'comment' => View::make('public.comment.comment', array('comment' => $comment))->render(), 'message' => Lang::get('comment.store_success')));
				} else {
					return Redirect::to($url)->with('success', Lang::get('comment.store_success'));
				}
			}

			if ( Request::ajax() ) {
				return Response::json(array('status' => 'danger', 'message' => Lang::get('comment.store_fail')));
			} else {
				return Redirect::to($url)->with('error', Lang::get('comment.store_fail'));
			}
		}

		if ( Request::ajax() ) {
			return Response::json(array('status' => 'danger', 'message' => $validator->messages()->all()));
		} else {
			return Redirect::to($url)->withInput()->withErrors($validator);
		}
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
				$comment = Comment::find($id);
				//if comment exists and if user is author OR admin !
				if (!empty($comment) && ($user->hasRole('admin') || $user->id == $comment->user_id)) {
					//Remove children
					foreach ($comment->children->all() as $child) {
						//Remove votes
						foreach ($child->votes as $vote) {
							if (!$vote->delete()) {
								if (Request::ajax()) {
									return Response::json(array('status' => 'danger', 'message' => Lang::get('comment.destroy_child_vote_fail')));
								} else {
									return Redirect::back()->with('error_comment', Lang::get('comment.destroy_child_vote_fail'));
								}
							}
						}
						if (!$child->delete()) {
							if (Request::ajax()) {
								return Response::json(array('status' => 'danger', 'message' => Lang::get('comment.destroy_child_fail')));
							} else {
								return Redirect::back()->with('error_comment', Lang::get('comment.destroy_child_fail'));
							}
						}
					}

					//Remove votes
					foreach ($comment->votes as $vote) {
						if (!$vote->delete()) {
							if (Request::ajax()) {
								return Response::json(array('status' => 'danger', 'message' => Lang::get('comment.destroy_comment_vote_fail')));
							} else {
								return Redirect::back()->with('error_comment', Lang::get('comment.destroy_comment_vote_fail'));
							}
						}
					}

					//Remove comment
					if ($comment->delete()) {
						if (Request::ajax()) {
							return Response::json(array('status' => 'success', 'message' => Lang::get('comment.destroy_success')));
						} else {
							return Redirect::back()->with('success_comment', Lang::get('comment.destroy_success'));
						}
					}
					if (Request::ajax()) {
						return Response::json(array('status' => 'warning', 'message' => Lang::get('comment.destroy_fail')));
					} else {
						return Redirect::back()->with('error_comment', Lang::get('comment.destroy_fail'));
					}
				}
				if (Request::ajax()) {
					return Response::json(array('status' => 'warning', 'message' => Lang::get('comment.destroy_denied')));
				} else {
					return Redirect::back()->with('error_comment', Lang::get('comment.destroy_denied'));
				}
			}
		}
		if (Request::ajax()) {
			return Response::json(array('status' => 'warning', 'message' => Lang::get('auth.you_must_be_logged')));
		} else {
			return Redirect::back()->with('notice_comment', Lang::get('auth.you_must_be_logged'));
		}
	}



}