<?php

class AdminCommentController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		// get all the comments
		$comments_to_confirm = Comment::where('isConfirm','=',false)->orderBy('created_at','DESC')->paginate(20);
		$comments = Comment::where('isConfirm','=',true)->orderBy('created_at','DESC')->paginate(20);

		// load the view and pass the comments
		return View::make('admin.comments.index', compact( 'comments', 'comments_to_confirm' ));
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
		$comment = Comment::find($id);
		if(empty($comment) || !isset($comment)){
			Session::flash('error', 'Cette avis est introuvable !');
			return Redirect::back();
		}
		$comment->delete();

		// redirect
		Session::flash('success', 'L\'avis a bien été supprimé !');
		return Redirect::back();
	}

	/**
	 *
	 * Confirm the comment (moderation)
	 *
	 * @param  int  $id
	 * @return Response
	 */


	public function confirm($id)
	{
		//confirm
		$comment = Comment::find($id);
		if(empty($comment) || !isset($comment)){
			//Session::flash('error', 'Ce avis est introuvable !');
			return Redirect::back()->with('error', 'Cette avis est introuvable !');
		}

		$comment->isConfirm = true;
		if($comment->save()){
			// redirect
			//Session::flash('success', 'Le avis a bien été publié !');
			return Redirect::back()->with('success', 'L\'avis a bien été publié !');
		}

		//Session::flash('error', 'Une erreur c\'est produite... Gardez votre calme !!!');
		return Redirect::back()->with('error', 'Une erreur c\'est produite... Gardez votre calme !!!');

	}
}