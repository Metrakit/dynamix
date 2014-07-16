<?php

class DynamixController extends BaseController {

	/**
	 * This method test if t   he route passed is in the urls array to show the good resource (page|post|category)
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function master( $slug )
	{
        $url = parent::slugExists( $slug );

        if( $url === false ) return Response::view('errors.404', array(), 404);
        
        $i18n_url = $url->i18n_id;
        
        //get the resource index with the i18n ID of the url
        $data = array();
        switch ( $url->resource_id ) {
            case 1://Category
                $data['category'] = Category::where('i18n_url','=',$i18n_url)->first();
                break;
            case 2://Post
                $data['post'] = Post::where('i18n_url','=',$i18n_url)->first();
                break;
            case 4://Page
                $data['page'] = Page::where('i18n_url','=',$i18n_url)->first();
                break;
        }

        //if $page empty error 500
        if( $data === null ) return View::make('errors.500');

        //return the index view with data
        return View::make( 'site.' . \Illuminate\Support\Pluralizer::plural(Cache::get('DB_Resource_name')[$url->resource_id], 2) . '.' . Cache::get('DB_Resource_name')[$url->resource_id] , $data );
	}
}