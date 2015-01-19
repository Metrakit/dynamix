<?php

class AdminBlockTypeController extends BaseController {

	/**
	 * return View of input to create a block
	 *
	 * @return Response
	 */
	public function getBlockType($name = null) {
		//test if field exist and from an ajax request
		if( $name != null ) {
			//find block type in db
			$name = BlockType::where('name','=',$name)->first();

			return Response::json(View::make( $name->path_to_view, array('index'=>Input::get('index'),'current_locale'=>Input::get('current_locale')) )->renderSections());
		}
		return Response::json('error');
	}
}
