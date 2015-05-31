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
				return Response::json(array('status' => 'warning', 'message' => I18n::get('auth.you_must_be_logged')));
			} else {
				return Redirect::to($url)->with('notice_comment', I18n::get('auth.you_must_be_logged'));
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
					if (Input::has('reply')) {
						return Response::json(array('status' => 'success', 'comment' => View::make('theme::' .'public.comment.reply-inner', array('child' => $comment))->render(), 'message' => I18n::get('comment.store_success')));
					} else {						
						return Response::json(array('status' => 'success', 'comment' => View::make('theme::' .'public.comment.comment', array('comment' => $comment))->render(), 'message' => I18n::get('comment.store_success')));
					}
				} else {
					return Redirect::to($url)->with('success', I18n::get('comment.store_success'));
				}
			}

			if ( Request::ajax() ) {
				return Response::json(array('status' => 'danger', 'message' => I18n::get('comment.store_fail')));
			} else {
				return Redirect::to($url)->with('error', I18n::get('comment.store_fail'));
			}
		}

		if ( Request::ajax() ) {
			return Response::json(array('status' => 'danger', 'message' => $validator->messages()->all()));
		} else {
			return Redirect::to($url)->withInput()->withErrors($validator);
		}
	}

	
	/**
	 * Update the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		if ( Request::ajax() ) {
			// Validate the inputs
			$validator = Validator::make(Input::all(), Config::get('validator.comment_edit'));

			if ( $validator->passes() ){
				if ( Auth::check() ) {
					$user = Auth::user();
					$comment = Comment::find($id);
					if ( !empty($user) && !empty($comment) ) {				
						if ($user->id == $comment->user_id) {//is author
							$comment->text = Input::get('message');
							if ($comment->save()) {
								//good
								return Response::json(array('status' => 'success', 'message' => I18n::get('comment.edit_success')));
							}
							//fail
							return Response::json(array('status' => 'danger', 'message' => I18n::get('comment.edit_fail')));
						}
						//not authorised
						App::abort(403, I18n::get('auth.you_are_not_authorized'));
					}
					//not found
					return Response::json(array('status' => 'warning', 'message' => I18n::get('comment.not_found')));
				}
				//need to be logged
				return Response::json(array('status' => 'warning', 'message' => I18n::get('auth.you_must_be_logged')));
			}
			//validator fail
			return Response::json(array('status' => 'danger', 'message' => $validator->messages()->all()));
		}

		App::abort(405, I18n::get('comment.update_405'));
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
									return Response::json(array('status' => 'danger', 'message' => I18n::get('comment.destroy_child_vote_fail')));
								} else {
									return Redirect::back()->with('error_comment', I18n::get('comment.destroy_child_vote_fail'));
								}
							}
						}
						if (!$child->delete()) {
							if (Request::ajax()) {
								return Response::json(array('status' => 'danger', 'message' => I18n::get('comment.destroy_child_fail')));
							} else {
								return Redirect::back()->with('error_comment', I18n::get('comment.destroy_child_fail'));
							}
						}
					}

					//Remove votes
					foreach ($comment->votes as $vote) {
						if (!$vote->delete()) {
							if (Request::ajax()) {
								return Response::json(array('status' => 'danger', 'message' => I18n::get('comment.destroy_comment_vote_fail')));
							} else {
								return Redirect::back()->with('error_comment', I18n::get('comment.destroy_comment_vote_fail'));
							}
						}
					}

					//Remove comment
					if ($comment->delete()) {
						if (Request::ajax()) {
							return Response::json(array('status' => 'success', 'message' => I18n::get('comment.destroy_success')));
						} else {
							return Redirect::back()->with('success_comment', I18n::get('comment.destroy_success'));
						}
					}
					if (Request::ajax()) {
						return Response::json(array('status' => 'warning', 'message' => I18n::get('comment.destroy_fail')));
					} else {
						return Redirect::back()->with('error_comment', I18n::get('comment.destroy_fail'));
					}
				}
				if (Request::ajax()) {
					return Response::json(array('status' => 'warning', 'message' => I18n::get('comment.destroy_denied')));
				} else {
					return Redirect::back()->with('error_comment', I18n::get('comment.destroy_denied'));
				}
			}
		}
		if (Request::ajax()) {
			return Response::json(array('status' => 'warning', 'message' => I18n::get('auth.you_must_be_logged')));
		} else {
			return Redirect::back()->with('notice_comment', I18n::get('auth.you_must_be_logged'));
		}
	}







	//Comment Vote
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function vote($id, $bool)
	{
		if ( Auth::check() ) {
			$user = Auth::user();
			if ( !empty($user) ) {
				//get comment
				$comment = Comment::find($id);
				if (!empty($comment)) {
					//check if user want to delete his vote : if a vote already exist and have same bool, it's an canceltion of vote
					$vote = CommentVote::where('user_id', $user->id)->where('comment_id', $id)->first();
					if (!empty($vote)) {//if vote exist
						if ($vote->is_positive == ($bool=='1'?true:false)) {//if vote have same bool = deletion of vote
							if ($vote->delete()) {
								if (Request::ajax()) {
									return Response::json(array('status' => 'success', 'action' => 'destroy', 'message' => I18n::get('comment.vote_canceled_success')));
								} else {
									return Redirect::back()->with('success_comment', I18n::get('comment.vote_canceled_success'));
								}
							}
						} else {//reverse vote
							$vote->is_positive = $bool;
							if ($vote->save()) {
								if (Request::ajax()) {
									return Response::json(array('status' => 'success', 'action' => 'reverse', 'message' => I18n::get('comment.vote_reverse_success')));
								} else {
									return Redirect::back()->with('success_comment', I18n::get('comment.vote_reverse_success'));
								}
							}
						}
					} else {//if not exist = create a new one !
						$vote = new CommentVote;
						$vote->is_positive = $bool;
						$vote->user_id = $user->id;
						$vote->comment_id = $id;
						if ($vote->save()){
							if (Request::ajax()) {
								return Response::json(array('status' => 'success', 'action' => 'create', 'message' => I18n::get('comment.vote_success')));
							} else {
								return Redirect::back()->with('success_comment', I18n::get('comment.vote_success'));
							}
						}
					}
					if (Request::ajax()) {
						return Response::json(array('status' => 'danger', 'message' => I18n::get('comment.vote_fail')));
					} else {
						return Redirect::back()->with('error_comment', I18n::get('comment.vote_fail'));
					}
				}
				//not find
				if (Request::ajax()) {
					return Response::json(array('status' => 'warning', 'message' => I18n::get('comment.not_find')));
				} else {
					return Redirect::back()->with('error_comment', I18n::get('comment.not_find'));
				}
			}
		}
		//denied
		if (Request::ajax()) {
			return Response::json(array('status' => 'warning', 'message' => I18n::get('auth.you_must_be_logged')));
		} else {
			return Redirect::back()->with('notice_comment', I18n::get('auth.you_must_be_logged'));
		}
	}

	public function report()
	{
		$id =  Input::get('comment-report-id');
		$user = Auth::user();
		$comment = Comment::find($id);
		$commentReport = new CommentReport;
		$commentReport->text = Input::get('message');
		$commentReport->user_id = $user->id;
		$commentReport->comment_id = $id;

		//Check auth
		if ( empty($user) ) {
			if ( Request::ajax() ) {
				return Response::json(array('status' => 'warning', 'message' => I18n::get('auth.you_must_be_logged')));
			} else {
				return Redirect::to($url)->with('notice_comment', I18n::get('auth.you_must_be_logged'));
			}
		}

		if ($user->id == $comment->user_id) {
			return Response::json(array('status' => 'danger' , 'message' => I18n::get('comment.signal_fail')));
		}

		if ($commentReport->save()) {
			return Response::json(array('status' => 'success', 'message' =>$id));
		}
		return Response::json(array('status' => 'danger', 'message' => I18n::get('comment.edit_fail')));
	}


}

