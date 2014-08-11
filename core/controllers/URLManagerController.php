<?php

class URLManagerController extends BaseController {

	public function init()
    {

    }

    public function getHome()
    {
        $urls = App::make('CacheController')->getCache( 'DB_Urls' );

        foreach ( $urls as $url ) {
            if ( $url['url'] == '/' ) {
                $page = Structure::where('i18n_url','=',$url['i18n_id'])->first()->structurable;
                return View::make( 'public.pages.page' , compact('page') );
            }
        }
         
        return View::make('errors.500');        
    }
}