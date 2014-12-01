<?php

class AdminBlockTypeController extends BaseController {

	/**
	 * return View of input to create a block
	 *
	 * @return Response
	 */
	public function getBlockType() {
		//test if field exist and from an ajax request
		if( Input::has('blockType') ) {
			$blockType = Input::get('blockType');

			//find block type in db
			$blockType = BlockType::where('name','=',$blockType)->first();

			return Response::json([ 'view' => View::make( $blockType->path_to_view )->render()]);
		}
		return Response::json('error');
	}
}
