<?php

class AdminRegisterController extends BaseController {

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$user = User::find($id);
		if(empty($user) || !isset($user) ){
			Session::flash('error','L\'utilisateur n\'existe pas !');
			return Redirect::to('/');
		}
		
		return View::make('user.show', compact('user'));
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
		if(empty($user) || !isset($user)){
			Session::flash('error', 'Cette utilisateur est introuvable !');
			return Redirect::back();
		}

		if($user->hasRole('admin')){
			Session::flash('error', 'Impossible de supprimer cette utilisateur');
			return Redirect::back();
		}
		$user->delete();

		// redirect
		Session::flash('success', 'L\'utilisateur a bien été supprimé !');
		return Redirect::back();
	}

}