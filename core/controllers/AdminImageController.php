<?php

class AdminImageController extends BaseController {

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($order)
	{
		$success = 'not sure !';
		// delete
		$image = Image::where('gallery_id','=',Input::get('gallery_id'))->where('order','=',$order)->first();
		if(empty($image)){
			return Redirect::to('admin/gallery/' . Input::get('gallery_id'))->with('error','Cette image n\'existe pas !');
		}

		$gallery = Gallery::find(Input::get('gallery_id'));
		if($image->id == $gallery->cover_id){
			$success = 'Vous avez supprimé la Cover de la Galerie ! Elle a été remplacé par la première image.';
		}

		//Regulation order in image
		$image->delete();
		
		DB::table('images')->where('gallery_id','=',Input::get('gallery_id'))->where('order','>',$order)->decrement('order');

		if($image->id == $gallery->cover_id){
			$gallery->cover_id = Image::where('gallery_id','=',Input::get('gallery_id'))->where('order','=',0)->first()->id;
			$gallery->save();
		}

		// redirect
		$success .= ' L\'image a été supprimé !';
		return Redirect::to('admin/gallery/' . Input::get('gallery_id'))->with('success',$success);
	}

}