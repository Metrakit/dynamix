<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($route, $request, $lang = 'auto')
{

    /*
    |--------------------------------------------------------------------------
    | Language
    |--------------------------------------------------------------------------
    |
    | Detect the browser language.
    |
    */

    //Session::forget('locale');
    /*if ( Schema::hasTable('migrations') && !Session::has('locale') ) {
        //get all enable langage
        $available_langages = DB::table('locales')->where('enable','=',1)->get();
        
        $available_langage = array();
        foreach($available_langages as $a)
        {
            $available_langage[] = $a->id;
        }

        Log::info('lang :: '.$lang);
        
        if ($lang != "auto" && in_array($lang , $available_langage)) {
            Config::set('app.locale', $lang);
        } else {
            $browser_lang = !empty($_SERVER['HTTP_ACCEPT_LANGUAGE']) ? strtok(strip_tags($_SERVER['HTTP_ACCEPT_LANGUAGE']), ',') : '';          
            $browser_lang = substr($browser_lang, 0,2);
            $userLang = (in_array($browser_lang, $available_langage)) ? $browser_lang : Config::get('app.locale');
            Config::set('app.locale', $userLang);
            App::setLocale($userLang);
        }
        Session::put('locale',Config::get('app.locale'));
    } else if (!Schema::hasTable('migrations')) {
        define('STDIN',fopen("php://stdin","r"));
        Artisan::call("migrate");
        Artisan::call("db:seed");
    }*/
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
    if (Auth::guest()) return Redirect::guest('user/login');
});


Route::filter('auth.basic', function()
{
    return Auth::basic();
});

Route::filter('auth.admin', function()
{
    if (Auth::check()){
        if(!Auth::user()->hasRole('admin')){
            return Redirect::guest('user/login');
        }
    }else{
        return Redirect::guest('user/login');
    }
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});

