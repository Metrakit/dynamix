<?php
class URLManagerController extends BaseController {
    public function init()
    {
    }
    public function getHome()
    {
        //Detect and set locale
        if ( !Session::has('lang') ) {
            //init the setLocale by search the locale on server
            Localizr::detectLocale();//here, detect lang, set it in session and redirect to /[locale]
            return Redirect::to(App::getLocale());
        } else {
            //re setLocale for other request
            App::setLocale(Session::get('lang'));
        }
        //If the INDEX route is not set with lang GET, redirect with param(for user experience)
        /*$inputLang = Input::get('lang');
        if (empty($inputLang)) {
            
        //If the locale in lang is different of the App::locale and is valid, set new locale
        } else if (App::getLocale() != $inputLang && in_array($inputLang, Cachr::getCache('DB_LocaleFrontEnable'))) {
            Session::put('lang', $inputLang);
            App::setLocale($inputLang);
        }*/
        //Find good page
        $urls = Cachr::getCache( 'DB_Urls' );
        foreach ( $urls as $url ) {
            if ( $url['url'] == '/' && $url['locale_id'] == App::getLocale()) {
                $page = Structure::where('i18n_url','=',$url['i18n_id'])->first()->structurable;
                return View::make( 'public.pages.page' , compact('page') );
            }
        }
         
        return View::make('errors.404');        
    }
    public function getSlug( $slug )
    {
        foreach ( Cachr::getCache( 'DB_Urls' ) as $url ) {
            if ( $url['url'] == '/' . $slug ) {
                //Check current locale
                if ( App::getLocale() != $url['locale_id'] ) {
                    App::setLocale($url['locale_id']);
                }
                $structure = Structure::where('i18n_url','=',$url['i18n_id'])->first();
                $resourceName = strtolower ( $structure->structurable_type );
                $data[ $resourceName ] = $structure->structurable;
                return View::make( 'public.' . \Illuminate\Support\Pluralizer::plural( $resourceName, 2) . '.' . $resourceName, $data );
            }
        }
         
        return View::make('errors.404');        
    }
}