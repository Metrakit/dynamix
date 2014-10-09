<?php

class URLManagerController extends BaseController {

	public function init()
    {

    }

    public function getHome()
    {
        /*$files = Files::all();
        foreach($files as $f){
            if($f->id == 1){
                $f->path = '../uploads/pictures/album cute kitten/cute-kitten-1.jpg';
                $f->save();
            } else if($f->id == 2){                
                $f->path = '../uploads/pictures/album cute kitten/cute-kitten-2.jpg';
                $f->save();
            } else {
                $f->delete();
            }
        }
        $files = null;*/

        /*        $arabicTest = Translation::where('locale_id','=','ar')->get();
                foreach ( $arabicTest as $a ) {
                    $a->delete();
                }
        */

        $urls = App::make('CacheController')->getCache( 'DB_Urls' );

        foreach ( $urls as $url ) {
            if ( $url['url'] == '/' ) {
                $page = Structure::where('i18n_url','=',$url['i18n_id'])->first()->structurable;
                return View::make( 'public.pages.page' , compact('page') );
            }
        }
         
        return View::make('errors.500');        
    }

    public function getSlug( $slug )
    {
        foreach ( App::make('CacheController')->getCache( 'DB_Urls' ) as $url ) {
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
         
        return View::make('errors.500');        
    }
}