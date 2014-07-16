<?php

class HomeController extends BaseController {

	public function index()
    {
        //get the url '/'
        $url = Urls::where('text','=','/')->first();
        //get th eid of the url container to find the good index
        $i18n_url = $url->i18n_id;
        //get the index index with the i18n ID
        $index = Page::where('i18n_url','=',$i18n_url)->first();

        //if $index empty error 500
        if(empty($index)) return View::make('errors.500');

        //Flag for Ariane
        $isIndex = true;

        //return the index view with data
        return View::make( 'site.index' , compact('index','isIndex') );
    }
}