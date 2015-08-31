<?php
class URLManagerController extends BaseController {
    public function redirectHome() {
        Redirect::to(App::getLocale());
    }
    
    public function getHome()
    {
        Session::put('old_RequestSegment2', '');
        
        //is root?
        //if (Request::is('/') && Locale::countEnable() > 1) return Redirect::to('/' . App::getLocale(), 301);
        
        //is OnePage?
        if (Config::get('core::display.onepage')) {
            $data = array();
            $data['onepage'] = OnePage::first();
            return View::make('theme::public.onepage', $data);
        } else {
            //Find good page
            $urls = Urls::getRoutes();
            foreach ( $urls as $url ) {
                if ( $url['url'] == '/' && $url['locale_id'] == App::getLocale()) {
                    $structure = Structure::where('i18n_url',$url['i18n_id'])->first();
                    if (!empty($structure)) {
                        if ($structure->structurable_type != 'OnePage') {
                            $page = $structure->structurable;
                            return View::make('pager::public.pages.page' , compact('page') );
                        }
                    }
                }
            }
            return App::abort(404);
        }
    }
}