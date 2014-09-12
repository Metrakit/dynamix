<?php

/*
|--------------------------------------------------------------------------
| Home
|--------------------------------------------------------------------------
|
|	Home Page
|
*/
//Index of website
Route::get('/', array('uses' => 'HomeController@index'));



/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
|
|	Admin
|
*/
Route::group( array('before' => 'auth.admin', 'prefix' => 'admin') , function (){
	//Index / Dashboard
	Route::get('/','AdminController@index');

	//PAGE
	Route::resource('page','AdminPageController',
		array('except' => array('show')) );

	//MENU
	Route::resource('menu','AdminMenuController',
		array('except' => array('create','store','show')) );
	Route::post('menu/{id}/move','AdminMenuController@move');
	
	Route::get('menu/create-new-menu','AdminMenuController@createNewMenu');
	Route::post('menu/create-new-menu','AdminMenuController@postCreateNewMenu');
	Route::get('menu/create-menu','AdminMenuController@createMenu');
	Route::post('menu/create-menu','AdminMenuController@postCreateMenu');

	//MOSAIQUES
	Route::resource('mosaique','AdminMosaiqueController',
		array('only' => array('index','edit','update')) );

	//GALLERY
	Route::resource('gallery','AdminGalleryController');
	Route::post('gallery/add-image','AdminGalleryController@postAddImage');
	Route::post('gallery/{order}/move','AdminGalleryController@move');

	//ARTICLE
	Route::resource('image','AdminImageController',
		array('only' => array('destroy')) );

	//USER
	Route::get('/user', 'AdminController@getUser');
	
	//MEDIA
	Route::get('/media', 'AdminController@getMedia');
	
	//OPTION
	Route::get('/option', 'AdminController@getOption');
	Route::post('/option', 'AdminController@postOption');
});



/*
|--------------------------------------------------------------------------
| User
|--------------------------------------------------------------------------
|
|	User
|
*/
Route::get('user/login', 'UserController@login');
Route::post('user/login', 'UserController@post_login');
Route::get('user/logout', 'UserController@logout');

Route::get('user/remind', 'RemindersController@getRemind');
Route::post('user/remind', 'RemindersController@postRemind');
Route::get('password/reset/{token}', array('uses' => 'RemindersController@getReset','as' => 'password.reset'));
Route::post('password/reset/{token}', array('uses' => 'RemindersController@postReset','as' => 'password.update'));

Route::resource('user','UserController', array('except' => array('index', 'show')) );



/*
|--------------------------------------------------------------------------
| Migration
|--------------------------------------------------------------------------
|
*/
Route::get('/migrate', function(){
  define('STDIN',fopen("php://stdin","r"));
  Artisan::call("migrate:reset");
  Artisan::call("migrate");
  Artisan::call("db:seed");
  return "migrated";
});




/*
|--------------------------------------------------------------------------
| Element (Category|Post|Page)
|--------------------------------------------------------------------------
|
|	Element (Category|Post|Page)
|
*/
Route::get('{slug}', array('uses' => 'URLManagerController@getSlug'));




/*
|--------------------------------------------------------------------------
| Composer before errors
|--------------------------------------------------------------------------
|
|	Composer before errors
|
*/
//Master layout
/*View::composer('errors.*', function ($view)
{
	$view->with( 'isError' , true );
});*/



/*
|--------------------------------------------------------------------------
| Error...
|--------------------------------------------------------------------------
|
|
*/
/*App::error(function($exception, $code)
{
    switch ($code)
    {
        case 403:
            return Response::view('errors.403', array(), 403);

        case 404:
            return Response::view('errors.404', array(), 404);

        case 500:
            return Response::view('errors.500', array(), 500);
    }
});*/



































/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
|
|	Admin
|
*/
/*Route::group( array('before' => 'auth', 'prefix' => 'admin') , function (){
	//Index / Dashboard
	Route::get('/','AdminController@index');

	//Manage Blog
	//Create, edit, delete Posts
	Route::resource('post','AdminPostController');
	Route::resource('page','AdminPageController',
		array('except' => array('create')) );

	Route::resource('slider','AdminSliderController');

	//Create (with User), edit, delete, return Comments
	Route::get('/','AdminController@index');

	//Manage Register
	Route::resource('register','AdminRegisterController',
		array('only' => array('destroy', 'show')) );

	//Manage Comments
	Route::resource('comment','AdminCommentController',
		array('only' => array('index', 'destroy')) );
	Route::post('comment/{id}/confirm', 'AdminCommentController@confirm');

	//Create, edit, delete Page
	//Route::get('/','AdminController@index');
});
*/

/*
|--------------------------------------------------------------------------
| User
|--------------------------------------------------------------------------
|
|	User
|
*/

//:: User Login Routes ::
//Login
/*Route::get('user/login', 'UserController@login');
Route::post('user/login', 'UserController@post_login');
//Logout
Route::get('user/logout', 'UserController@logout');
//Forgot password
Route::get('user/forgot', 'UserController@forgot');
Route::post('user/forgot', 'UserController@post_forgot');
//:: User (Create, Edit, Remove, etc..) ::
Route::resource('user','UserController',
		array('except' => array('create')) );

*/



/*
|--------------------------------------------------------------------------
| Control
|--------------------------------------------------------------------------
|
|	Control
|
*/
/*Route::get('/control/{id}/{bool}/{sha}','BlogController@getAction');

*/

/*
|--------------------------------------------------------------------------
| Blog
|--------------------------------------------------------------------------
|
|	Blog
|
*/
//Index of blog (actualite)
/*Route::get('{blogName}', array('uses' => 'BlogController@index'));

Route::get('{blogPost}', 'BlogController@getView');
Route::post('{blogPost}', 'BlogController@postView');
*/

//Test
//Route::get('/test', 'StaticController@test');

/*
|--------------------------------------------------------------------------
| Composer
|--------------------------------------------------------------------------
|
|	Composer
|
*/
//View::composer('*', 'MasterComposer');