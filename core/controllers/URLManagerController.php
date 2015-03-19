<?php
class URLManagerController extends BaseController {
    public function redirectHome() {
        Redirect::to(App::getLocale());
    }
    
    public function getHome()
    {
        Session::put('old_RequestSegment2', '');
        //is OnePage?
        if (Config::get('display.onepage')) {
            $data = array();
            $data['onepage'] = OnePage::first();
            return View::make('theme::' .'public.onepage', $data);
        } else {
            //Find good page
            if(Request::is('/')) return Redirect::to('/'.App::getLocale(),301);
            $urls = Cachr::getCache( 'DB_Urls' );
            foreach ( $urls as $url ) {
                if ( $url['url'] == '/' && $url['locale_id'] == App::getLocale()) {
                    $page = Structure::where('i18n_url','=',$url['i18n_id'])->first()->structurable;
                    return View::make('theme::' . 'public.pages.page' , compact('page') );
                }
            }
            return View::make('theme::' .'errors.404');        
        }
    }
    
    public function getSlug( $slug )
    {
        Session::put('old_RequestSegment2', Request::segment(2));
        if( Session::has('translate_request') ) {
            Session::forget('translate_request');
            return $this->translateAndRedirect(Request::segment(2), Request::segment(1));
        } else {
            foreach ( Cachr::getCache( 'DB_Urls' ) as $url ) {
                if ( $url['url'] == '/' . $slug ) {
                    //Check current locale
                    if ( App::getLocale() != $url['locale_id'] ) {
                        App::setLocale($url['locale_id'] . '.UTF8');
                    }
                    $structure = Structure::where('i18n_url','=',$url['i18n_id'])->first();
                    $resourceName = strtolower ( $structure->structurable_type );
                    $data[ $resourceName ] = $structure->structurable;
                    return View::make('theme::' . $resourceName::$blockContentView, $data );
                }
            }
        }
        return View::make('theme::' .'errors.404');        
    }
    public function translateAndRedirect( $slug_origin, $locale_new )
    {
        Log::info('translate');
        foreach ( Cachr::getCache( 'DB_Urls' ) as $url ) {
            if ( $url['url'] == '/' . $slug_origin ) {
                //Search route with the same i18n_id and with the new locale
                foreach ( Cachr::getCache( 'DB_Urls' ) as $url_translated ) {
                    if ( $url_translated['i18n_id'] == $url['i18n_id'] && $url_translated['locale_id'] == $locale_new && $url_translated['url'] != $url['url'] ) {               
                        return Redirect::to('/' . $url_translated['locale_id'] . $url_translated['url'] );
                    }
                }
            }
        }
        return View::make('theme::' .'errors.500');        
    }
}